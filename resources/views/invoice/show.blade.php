@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    {{-- Logo --}}
    <div class="flex items-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 mr-4">
        <h2 class="text-3xl font-bold text-pink-600">Invoice #{{ $order->invoice_number }}</h2>
    </div>

    {{-- Informasi Umum --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Informasi Pemesanan</h3>
        <div class="space-y-2 text-sm text-gray-600">
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
            <p><strong>Status:</strong> <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">{{ $order->status }}</span></p>
        </div>
    </div>

    {{-- Rincian Produk --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Rincian Produk</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 font-semibold">Produk</th>
                        <th class="py-2 px-4 font-semibold">Harga</th>
                        <th class="py-2 px-4 font-semibold">Jumlah</th>
                        <th class="py-2 px-4 font-semibold">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $item->product->name }}</td>
                            <td class="py-2 px-4">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="py-2 px-4">{{ $item->quantity }}</td>
                            <td class="py-2 px-4">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-right mt-4 font-semibold text-lg text-pink-600">
            Total: Rp{{ number_format($order->total_price, 0, ',', '.') }}
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <div class="text-center">
        <a href="{{ route('home') }}" class="inline-block bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded transition duration-200">
            ← Kembali ke Home
        </a>
        <a href="{{ route('orders.user') }}" class="inline-block bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded transition duration-200">
            ← Lihat Riwayat Pesanan
        </a>
    </div>
</div>
@endsection
