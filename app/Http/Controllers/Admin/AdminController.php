<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
{
    $totalProduk = Product::count();
    $stokMenipis = Product::where('stock', '<', 5)->count();

    return view('admin.dashboard', compact('totalProduk', 'stokMenipis'));
}
}
