<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(8)->get(); // tampilkan 8 produk terbaru
        return view('home', compact('products'));
    }
}
