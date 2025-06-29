@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4">
    <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

    @foreach($carts as $cart)
    <div class="flex justify-between items-center border-b py-4">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('storage/' . $cart->product->image) }}" class="w-24 h-24 object-cover rounded">
            <div>
                <h2 class="font-semibold">{{ $cart->product->name }}</h2>
                <p class="text-sm text-gray-600">Rp{{ number_format($cart->product->price, 0, ',', '.') }}</p>
                <p class="text-xs text-gray-500 mt-1">Alamat: {{ $cart->alamat }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('cart.remove', $cart->id) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-600 hover:underline">Hapus</button>
        </form>
    </div>
    @endforeach
</div>
@endsection
