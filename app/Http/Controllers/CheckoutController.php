<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('checkout.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|string',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Simpan ke table orders
        $order = Order::create([
            'user_id' => Auth::id(),
            'invoice_number' => 'INV-' . strtoupper(Str::random(6)),
            'status' => 'pending',
            'total_price' => $total,
            'payment_method' => $request->metode_pembayaran,
        ]);

        // Simpan ke order_items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Hapus isi cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('invoice.show', $order->id);
    }

    public function showInvoice($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('invoice.show', compact('order'));
    }
}

