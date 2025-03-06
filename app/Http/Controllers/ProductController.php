<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('variants')->firstOrFail();
        $categories = Category::all();

        $similarProducts = Product::where('subcategory_id', $product->subcategory_id)
            ->where('id', '!=', $product->id)
            ->take(5)
            ->get();

        return view('product.show', compact('product', 'similarProducts','categories'));
    }
}
