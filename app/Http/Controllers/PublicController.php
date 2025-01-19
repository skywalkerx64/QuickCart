<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Requests\Product\SearchProductRequest;

class PublicController extends Controller
{
    public function home()
    {
        return Inertia::render('Public/Home', [
            'featuredProducts' => Product::orderByDesc('created_at')->limit(3)->get()
        ]);
    }

    public function contact()
    {
        return Inertia::render('Public/Contact');
    }

    public function shop(SearchProductRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $category = $request->category;
        $per_page = $request->per_page ?? 9;

        $products = Product::query()->where('status', Product::PUBLISHED_STATUS)->orderByDesc('created_at');

        if($name && $name != '') $products = $products->where('name', 'like', '%' . $name . '%');
        if($description && $description != '') $products = $products->where('description', 'like', '%' . $description . '%');
        if($category && $category != '') $products = $products->where('category', $category);

        return Inertia::render('Public/Shop', [
            'products' => $products->paginate($per_page),
            'categories' => ProductCategory::all(),
        ]);
    }
}
