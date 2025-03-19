<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(\App\Http\Middleware\ShareCategories::class);

Route::get('/contact', function () {
    return view('contact', ['child' => 'Contact Us']);
})->name('contact');


Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/about-us', function () {
    return view('about-us');
})->middleware(\App\Http\Middleware\ShareCategories::class);

Route::get('/get-variant-price', function (Request $request) {
    $variant = ProductVariant::where('product_id', $request->product_id)
        ->where('color_id', $request->color_id)
        ->where('size_id', $request->size_id)
        ->first();

    return response()->json(['price' => $variant ? $variant->price : '---']);
});

Route::get('/get-available-colors', [ProductController::class, 'getAvailableColors']);
Route::get('/get-available-sizes', [ProductController::class, 'getAvailableSizes']);

Route::post('/order/quick-order', [OrderController::class, 'quickOrder'])->name('quick.order');



Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware(\App\Http\Middleware\ShareCategories::class);;
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

