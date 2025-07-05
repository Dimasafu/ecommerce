@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<div class="bg-gradient-to-br from-pink-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
        <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0">
            <h1 class="text-5xl font-extrabold text-gray-800 leading-tight mb-4">
                Pesan 
                <span 
                    x-data="{
                        words: ['Gift', 'Hadiah', 'Bunga'],
                        active: 0,
                        get current() { return this.words[this.active] },
                        next() { 
                            this.active = (this.active + 1) % this.words.length 
                        }
                    }"
                    x-init="setInterval(() => { 
                        // Animate out
                        $refs.word.classList.add('animate-slide-up');
                        setTimeout(() => {
                            next(); 
                            $refs.word.classList.remove('animate-slide-up');
                        }, 200);
                    }, 2000)"
                    class="relative inline-block"
                >
                    <span 
                        x-ref="word"
                        x-text="current"
                        class="text-pink-600 transition-all duration-300"
                    ></span>
                </span>
                <br> Mudah dan Cepat
            </h1>
            <style>
            @keyframes slideUp {
                0% { opacity: 1; transform: translateY(0);}
                100% { opacity: 0; transform: translateY(-30px);}
            }
            .animate-slide-up {
                animation: slideUp 0.3s forwards;
            }
            </style>
            <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
            <p class="text-lg text-gray-600 mb-6">
                Kirim Bunga & Gift ke seluruh Indonesia. <br>
                <span class="font-semibold">Garansi Kualitas & Pengiriman Tepat Waktu</span>
            </p>
            <a href="#produk" class="inline-block px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg transition">
                Pilih Bunga & Gift
            </a>
            <div class="flex space-x-6 mt-6 text-gray-700 justify-center md:justify-start">
                <div><span class="font-bold text-xl">2000+</span><br><span class="text-sm">Order/bulan</span></div>
                <div><span class="font-bold text-xl">118+</span><br><span class="text-sm">Wilayah</span></div>
                <div><span class="font-bold text-xl">4.8/5</span><br><span class="text-sm">Rating</span></div>
            </div>
        </div>
        <div class="md:w-1/2">
            <img src="{{ asset('images/banner.jpg') }}" alt="Florist Banner" class="rounded-3xl shadow-xl w-full max-w-md mx-auto">
        </div>
    </div>
</div>

{{-- Carousel Kategori --}}
<div class="bg-white py-8 px-4">
    <div class="max-w-7xl mx-auto flex overflow-x-auto space-x-6">
        @if($categories->count())
            @foreach($categories as $category)
                <div class="flex-shrink-0 w-24 text-center">
                    <div class="w-16 h-16 bg-pink-100 rounded-full mx-auto flex items-center justify-center">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-8 h-8 object-contain">
                        @else
                            <span class="text-sm text-gray-400">No Img</span>
                        @endif
                    </div>
                    <p class="mt-2 text-sm text-gray-700">{{ $category->name }}</p>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-500">Kategori produk belum diisi.</p>
        @endif
    </div>
</div>

{{-- Produk Section --}}
<div id="produk" class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Katalog Produk</h2>
        <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
            <a href="{{ route('products.show', $product->slug) }}">
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
