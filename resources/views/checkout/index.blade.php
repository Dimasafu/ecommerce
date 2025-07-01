@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold text-pink-600 mb-6">Checkout</h2>

        @if ($cartItems->isEmpty())
            <div class="bg-blue-100 text-blue-800 border border-blue-300 rounded px-4 py-3 mb-4">
                Keranjang kamu masih kosong.
            </div>
            <a href="{{ route('products') }}"
               class="inline-block bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded">
                Belanja Sekarang
            </a>
        @else
            <div class="grid md:grid-cols-3 gap-6">
                <!-- List Produk -->
                <div class="md:col-span-2 space-y-4">
                    @foreach ($cartItems as $item)
                        <div class="bg-white shadow rounded flex gap-4 p-4">
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                 alt="{{ $item->product->name }}"
                                 class="w-24 h-24 object-cover rounded border">

                            <div class="flex-1">
                                <h3 class="text-lg font-medium">{{ $item->product->name }}</h3>
                                <p class="text-gray-600 text-sm">Jumlah: {{ $item->quantity }}</p>
                                <p class="text-pink-600 font-semibold mt-1">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Form Alamat -->
                    <div class="bg-white shadow rounded p-6">
                        <h4 class="text-lg font-semibold mb-4">Alamat Pengiriman</h4>
                        <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="alamat" class="block font-medium text-sm">Alamat Lengkap</label>
                                <textarea name="alamat" rows="3" required
                                          class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-1 focus:ring-pink-400">{{ old('alamat', $alamat ?? '') }}</textarea>
                            </div>
                            <div>
                                <label for="kota" class="block font-medium text-sm">Kota/Kabupaten</label>
                                <input type="text" name="kota" required
                                       class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-1 focus:ring-pink-400">
                            </div>
                            <div>
                                <label for="kecamatan" class="block font-medium text-sm">Kecamatan</label>
                                <input type="text" name="kecamatan" required
                                       class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-1 focus:ring-pink-400">
                            </div>
                            <div>
                                <label for="kelurahan" class="block font-medium text-sm">Kelurahan</label>
                                <input type="text" name="kelurahan" required
                                       class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-1 focus:ring-pink-400">
                            </div>
                            <div>
                                <label for="metode_pembayaran" class="block font-medium text-sm">Metode Pembayaran</label>
                                <select name="metode_pembayaran" required
                                        class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-1 focus:ring-pink-400">
                                    <option value="">Pilih metode</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                    <option value="COD">Cash on Delivery</option>
                                    <option value="E-Wallet">E-Wallet</option>
                                </select>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit"
                                        class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded transition">
                                    Bayar Sekarang
                                </button>
                                <a href="{{ route('products') }}"
                                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded">
                                    Belanja Lagi
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Ringkasan -->
                <div class="bg-white shadow rounded p-6">
                    <h4 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h4>
                    @php $total = 0; @endphp
                    @foreach ($cartItems as $item)
                        @php $total += $item->product->price * $item->quantity; @endphp
                    @endforeach
                    <div class="text-gray-700 text-sm">
                        Total Harga:
                        <span class="text-pink-600 font-semibold text-lg">
                            Rp{{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
