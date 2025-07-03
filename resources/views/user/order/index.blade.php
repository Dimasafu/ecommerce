@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <h2 class="text-3xl font-bold text-pink-600 mb-8 text-center">Riwayat Pesanan</h2>

    @forelse ($orders as $order)
        <div class="bg-white rounded-lg shadow-md p-6 mb-6 border border-gray-200">
            <div class="flex justify-between items-start flex-wrap gap-2">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Invoice: <span class="text-pink-600">{{ $order->invoice_number }}</span></h3>
                    <p class="text-gray-600 text-sm mb-1">
                        <strong>Status:</strong>
                        @if ($order->status === 'pending')
                            <span class="text-yellow-500">Menunggu Pembayaran</span>
                        @elseif ($order->status === 'processing')
                            <span class="text-blue-500">Diproses</span>
                        @elseif ($order->status === 'packing')
                            <span class="text-purple-500">Sedang Dikemas</span>
                        @elseif ($order->status === 'on delivery')
                            <span class="text-indigo-500">Dalam Pengiriman</span>
                        @elseif ($order->status === 'success')
                            <span class="text-green-600">Selesai</span>
                        @else
                            <span class="text-gray-500">{{ ucfirst($order->status) }}</span>
                        @endif
                    </p>
                    <p class="text-gray-600 text-sm"><strong>Total:</strong> Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>
                <div class="mt-2">
                    <a href="{{ route('invoice.show', $order->id) }}" class="inline-block bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded text-sm font-medium">
                        Lihat Detail
                    </a>
                </div>
            </div>

            <hr class="my-4">

            <div>
                <h4 class="text-sm font-semibold text-gray-700 mb-2">Produk:</h4>
                <ul class="space-y-2">
                    @foreach ($order->items as $item)
                        <li class="flex items-center justify-between">
                            <span class="text-gray-800">{{ $item->product->name }} x{{ $item->quantity }}</span>
                            <span class="text-gray-600">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <p class="text-center text-gray-500">Belum ada riwayat pesanan.</p>
    @endforelse
</div>
@endsection
