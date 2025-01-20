<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\EditProductRequest;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Requests\Product\SearchProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     */
    public function index(SearchProductRequest $request) {
        $products = Product::query()->orderByDesc('created_at')->where('user_id', Auth::user()->id);
        $per_page = $request->per_page ?? 10;


        return Inertia::render('Product/Index', [
            'products' => $products->paginate($per_page),
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return Inertia::render('Product/Create', [
            'categories' => ProductCategory::all(),
            'statuses' => Product::STATUSES,
        ]);
    }

    public function featuredProducts()
    {
        return response(Product::orderByDesc('created_at')->limit(3)->get());
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            ...$request->validated(),
            'user_id' => Auth::user()->id
        ]);

        if($request->hasFile('cover')) {
            $product->addMediaFromRequest('cover')->toMediaCollection(Product::COVER_MEDIA_COLLECTION);
        }

        if($request->hasFile('images')) {
            $product->addMediaFromRequest('images')->toMediaCollection(Product::IMAGES_MEDIA_COLLECTION);
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return Inertia::render('Product/Show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit', [
            'categories' => ProductCategory::all(),
            'statuses' => Product::STATUSES,
            'product' => $product
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(EditProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        if($request->hasFile('cover')) {
            $product->clearMediaCollection(Product::COVER_MEDIA_COLLECTION);
            $product->addMediaFromRequest('cover')->toMediaCollection(Product::COVER_MEDIA_COLLECTION);
        }

        if($request->hasFile('images')) {
            $product->clearMediaCollection(Product::IMAGES_MEDIA_COLLECTION);
            foreach($request->images as $image) {
                $product->addMedia($image)->toMediaCollection(Product::IMAGES_MEDIA_COLLECTION);
            }
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
