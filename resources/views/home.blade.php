@extends('layouts.app')

@section('content')
<div class="bg-white py-10">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800">Bunga Segar Untuk Segala Momen</h1>
            <p class="mt-2 text-gray-600">Kirim bunga terbaik untuk orang tercinta hanya dari toko bunga kami.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-pink-600 font-bold mt-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500">Belum ada produk tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
