<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popularProducts = Product::take(5)->with('variants')->get();

        return view('home.index',compact('popularProducts'));
    }
}
