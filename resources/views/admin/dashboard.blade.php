@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <!-- Total Produk -->
    <div class="bg-white p-4 rounded shadow">
        <h5 class="font-semibold text-lg">Total Produk</h5>
        <p>{{ $totalProduk }}</p>
    </div>

    <!-- Produk dengan stok < 5 -->
    <div class="bg-white p-4 rounded shadow">
        <h5 class="font-semibold text-lg">Produk dengan Stok &lt; 5</h5>
        <p>{{ $produkStokRendah }}</p>
    </div>

    <!-- Total Pesanan -->
    <div class="bg-white p-4 rounded shadow">
        <h5 class="font-semibold text-lg">Total Pemesanan</h5>
        <p>{{ $totalOrder }}</p>
    </div>
</div>

<!-- Tabel Status Pesanan -->
<div class="bg-white p-4 rounded shadow">
    <h5 class="font-semibold text-lg mb-3">Jumlah Pesanan Berdasarkan Status</h5>
    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left p-2 border">Status</th>
                <th class="text-left p-2 border">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ordersByStatus as $status => $jumlah)
                <tr>
                    <td class="p-2 border capitalize">{{ $status }}</td>
                    <td class="p-2 border">{{ $jumlah }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="p-2 text-center">Belum ada pesanan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection