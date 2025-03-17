<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

    public function getAvailableColors(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $availableColors = $product->variants()->where('size_id', $request->size_id)->pluck('color_id')->unique();
        return response()->json(['colors' => $availableColors]);
    }

    public function getAvailableSizes(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $availableSizes = $product->variants()->where('color_id', $request->color_id)->pluck('size_id')->unique();
        return response()->json(['sizes' => $availableSizes]);
    }

    public function updatePrice(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::find($productId);

        // Перевірка на мінімальну кількість виключена
        $totalPrice = $product->price * $quantity;

        return response()->json(['totalPrice' => $totalPrice]);
    }
}
