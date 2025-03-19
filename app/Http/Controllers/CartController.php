<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function removeFromCart($id)
    {

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json(['message' => 'Товар видалено!']);
    }

    public function clearCart()
    {
        session()->forget('cart');
        return response()->json(['message' => 'Корзину очищено!']);
    }


    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:product_colors,id',
            'size_id' => 'required|exists:product_sizes,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $variant = ProductVariant::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)
            ->firstOrFail();

        $key = "{$request->product_id}_{$request->color_id}_{$request->size_id}";

        $cart = session()->get('cart', []);

        // Якщо товар вже є в кошику, збільшити кількість
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity;
        } else {
            // Додати новий товар у кошик
            $cart[$key] = [
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'product_name' => $variant->product->name, // Додаємо назву продукту
                'variant_images' => $variant->image, // Додаємо фото варіанту
                'variant_price' => $variant->price, // Додаємо фото варіанту
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Товар додано в кошик']);
    }



}
