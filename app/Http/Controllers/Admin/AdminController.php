<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
{
    $totalProduk = \App\Models\Product::count();
    $produkStokRendah = \App\Models\Product::where('stock', '<', 5)->count();
    $totalOrder = Order::count();

    // Hitung jumlah order berdasarkan status
    $ordersByStatus = Order::selectRaw('status, COUNT(*) as jumlah')
        ->groupBy('status')
        ->pluck('jumlah', 'status');

    return view('admin.dashboard', compact('totalProduk', 'produkStokRendah', 'totalOrder', 'ordersByStatus'));
}
}
