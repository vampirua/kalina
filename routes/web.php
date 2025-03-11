<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CategoryController;

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


