<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::query()->orderByDesc('created_at');
        $per_page = $request->per_page ?? 10;


        return Inertia::render('Customer/Index', [
            'customers' => $customers->paginate($per_page),
        ]);
    }
}
