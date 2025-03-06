<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        // Знаходимо продукт за його slug
        $product = Product::where('slug', $slug)->with('variants')->firstOrFail();

        // Отримуємо схожі продукти з тієї ж категорії
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(5)  // Наприклад, беремо 5 схожих товарів
            ->get();

        // Повертаємо в представлення сторінки продукту
        return view('product.show', compact('product', 'similarProducts'));
    }
}
