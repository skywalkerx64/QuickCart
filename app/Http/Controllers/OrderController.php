<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Mail\OrderShipped;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Order\StoreOrderRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()->orderByDesc('created_at');
        $per_page = $request->per_page ?? 10;


        return Inertia::render('Order/Index', [
            'orders' => $orders->paginate($per_page),
        ]);
    }
    public function store(StoreOrderRequest $request)
    {
        $customer_data = $request->customer;
        $products = $request->products;

        $customer = Customer::firstOrCreate(
            [
                'email' => $customer_data['email']
            ],
            [
                'reference' => 'CUST' . Str::random(8),
                'email' => $customer_data['email'],
                'name' => $customer_data['name'],
                'contact' => $customer_data['contact'],
                'address' => $customer_data['address'],
            ]
        );

        $order = Order::create([
            'reference' => 'ORD' . Str::random(8),
            'customer_id' => $customer->id,
            'status' => Order::PLACED_STATUS
        ]);

        foreach ($products as $product_data) {

            $product = Product::find($product_data['id']);

            $order_detail = OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $product_data['quantity'],
                'total' => $product->price * $product_data['quantity'],
                'tax' => 18 * $product->price * $product_data['quantity'] / 100
            ]);
        }
        $order->refresh()->load('details');

        $order->update([
            'total' => $order->details->sum('total'),
            'tax' => $order->details->sum('tax')
        ]);

        return redirect()->route('shop');
    }

    public function processOrder(Order $order)
    {
        $order->update([
            'status' => Order::DELIVERED_STATUS
        ]);

        $customer = $order->customer;

        // Mail::to($customer->email)->send(new OrderShipped($order));

        return redirect()->route('orders.index');
    }

    public function myOrders(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        return Inertia::render('Order/MyOrders', [
            'orders' => Order::query()->orderByDesc('created_at')->whereHas('customer', fn($q) => $q->where('user_id', Auth::user()->id))->paginate($per_page),
        ]);
    }
}
