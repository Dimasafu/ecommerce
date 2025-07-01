@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 font-bold text-2xl text-gray-800">Invoice #{{ $order->invoice_number }}</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
            <p><strong>Status:</strong> <span class="badge bg-info text-dark">{{ $order->status }}</span></p>
        </div>
    </div>

    <div class="card p-4">
        <h5>Rincian Produk</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <h5 class="text-end">Total: Rp{{ number_format($order->total_price, 0, ',', '.') }}</h5>
    </div>
</div>
@endsection
