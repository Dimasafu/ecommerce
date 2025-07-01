@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6 text-pink-600 flex items-center gap-2">
            <i class="fas fa-shopping-cart"></i> Keranjang Belanja
        </h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($cartItems as $item)
            <div class="bg-white shadow-md rounded-lg mb-4 p-4 flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                         class="w-24 h-24 object-cover rounded-md border">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $item->product->name }}</h3>
                        <p class="text-sm text-gray-500">Stok: {{ $item->product->stock }}</p>
                        <p class="text-sm text-gray-600 mt-1">Harga Satuan: <span class="text-pink-600 font-semibold">Rp{{ number_format($item->product->price) }}</span></p>
                        <p class="text-sm mt-1">Jumlah: {{ $item->quantity }}</p>
                        <p class="text-sm mt-1 font-medium">Total Harga: <span class="text-pink-600 font-semibold">Rp{{ number_format($item->product->price * $item->quantity) }}</span></p>
                    </div>
                </div>

                <form method="POST" action="{{ route('cart.remove', $item->id) }}" class="mt-4 md:mt-0">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-600">Keranjang masih kosong.</p>
        @endforelse

        @if ($cartItems->count())
            <div class="mt-6 flex flex-col md:flex-row items-center justify-between">
                <a href="{{ route('products') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded mb-4 md:mb-0">
                    ← Belanja Lagi
                </a>

                <div class="text-lg font-semibold">
                    Total: 
                    <span class="text-pink-600">
                        Rp{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity)) }}
                    </span>
                </div>

                <a href="{{ route('checkout.index') }}"
                   class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded transition ml-0 md:ml-4">
                    Checkout
                </a>
            </div>
        @endif
    </div>
@endsection
