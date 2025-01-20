<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Order\StoreOrderRequest;
use Inertia\Inertia;

class OrderController extends Controller
{
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
}
