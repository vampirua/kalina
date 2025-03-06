<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category, Request $request)
    {
        $categories = Category::all();
        // Початковий запит на отримання продуктів по категорії та підкатегорії
        $products = Product::whereHas('category', function($query) use ($category) {
            $query->where('categories.id', $category->id); // Вказуємо таблицю для id
        });

        // Фільтрація по підкатегоріях
        if ($request->has('subcategory_id') && $request->get('subcategory_id') !== null) {
            $products->where('products.subcategory_id', $request->get('subcategory_id')); // Додаємо префікс 'products.'
        }

        // Фільтрація по ціні
        if ($request->has('price_from') && $request->get('price_from') !== null) {
            $products->where('products.price', '>=', $request->get('price_from')); // Вказуємо таблицю для ціни
        }

        if ($request->has('price_to') && $request->get('price_to') !== null) {
            $products->where('products.price', '<=', $request->get('price_to')); // Вказуємо таблицю для ціни
        }

        // Пагінація
        $products = $products->paginate(12);

        return view('category.show', compact('category', 'products','categories'));
    }
}
