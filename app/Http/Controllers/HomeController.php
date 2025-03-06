<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popularProducts = Product::take(5)->with('variants')->get();
        $categories = Category::all();

        return view('home.index',compact('popularProducts','categories'));
    }
}
