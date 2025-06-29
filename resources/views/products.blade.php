@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <!-- Banner Promo -->
        <div class="relative bg-cover bg-center h-[400px] md:h-[420px] flex items-center justify-center"
             style="background-image: url('{{ asset('images/banner.jpg') }}');">
            <div class="bg-white bg-opacity-90 rounded-xl p-9 md:p-10 text-center shadow-lg max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Bunga Spesial untuk Momen Spesial</h2>
                <p class="text-gray-600 text-lg text-align-center">
                     Kami siap membantu Anda mengirimkan bunga dengan tampilan sesuai keinginan! Bisa custom sesuai warna,
                    jenis bunga, atau pesan pribadi. Kiriman Anda akan menjadi lebih bermakna dan berkesan.
                </p>
                <a href="#"
                   class="inline-block mt-6 px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg transition">
                    <i class="fab fa-whatsapp mr-2"></i> Hubungi Kami
                </a>
            </div>
        </div>

        <div class="container mx-auto px-4 py-12">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-10">Semua Produk</h1>

            <!-- Search & Sort -->
            <form method="GET" action="{{ route('products') }}"
                class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                    class="border rounded-lg px-4 py-2 w-full md:w-1/2 focus:ring-2 ring-pink-300" />

                <select name="sort" onchange="this.form.submit()"
                    class="border rounded-lg px-4 py-2 focus:ring-2 ring-pink-300">
                    <option value="">Urutkan</option>
                    <option value="low_high" {{ request('sort') == 'low_high' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="high_low" {{ request('sort') == 'high_low' ? 'selected' : '' }}>Harga Tertinggi</option>
                </select>
            </form>

            <!-- Product Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="flex flex-col justify-between bg-white rounded-xl overflow-hidden shadow hover:shadow-xl transition">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800">{{ $product->name }}</h3>
                                <p class="text-pink-600 font-bold mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="p-4 pt-0">
                            @csrf
                            <button type="submit"
                                class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 rounded-lg transition">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="col-span-4 text-center text-gray-500">Tidak ada produk ditemukan.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
