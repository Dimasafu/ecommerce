@extends('layouts.app')

@section('content')
<div class="bg-white py-12">
    <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-xl w-full h-auto shadow-lg">
        
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
            <p class="text-lg text-gray-600 mb-4">{{ $product->description }}</p>
            <p class="text-2xl text-pink-600 font-bold mb-6">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-1 text-gray-700">Alamat Pengiriman</label>
                    <textarea name="alamat" class="w-full border rounded-lg p-3" rows="3" required></textarea>
                </div>
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg shadow">
                    Tambahkan ke Keranjang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
