<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/test', [TestController::class, 'test'])->name('test');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/shop', [PublicController::class, 'shop'])->name('shop');
Route::get('/checkout', [PublicController::class, 'checkout'])->name('checkout');
Route::get('/settings', [PublicController::class, 'settings'])->name('settings');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products/featured', [ProductController::class, 'featuredProducts'])->name('products.featured');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::resource('products', ProductController::class);
    Route::get('orders/me', [OrderController::class, 'myOrders'])->name('orders.my-orders');
    Route::resource('orders', OrderController::class)->except(['store']);
    Route::get('orders/{order}/process', [OrderController::class, 'processOrder'])->name('orders.process');
    Route::post('settings/update-key', [PublicController::class, 'updateKey'])->name('settings.update-key');
});

require __DIR__.'/auth.php';
