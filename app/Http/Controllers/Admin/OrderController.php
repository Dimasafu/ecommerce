<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil semua order dengan relasi user, items, dan product
        $orders = Order::with(['user', 'items.product'])->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        $oldStatus = $order->status;

        $order->update(['status' => $request->status]);

        // Kurangi stok jika status diubah ke success dan sebelumnya bukan success
        if ($request->status === 'success' && $oldStatus !== 'success') {
            foreach ($order->items as $item) {
                $item->product->decrement('stock', $item->quantity);
            }
        }

        return redirect()->back()->with('success', 'Status pesanan diperbarui.');
    }
    public function userOrders()
    {
        $orders = Order::with('items.product')->where('user_id', Auth::id())->latest()->get();
        return view('user.order.index', compact('orders'));
    }
}
