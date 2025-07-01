@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 font-bold text-2xl text-gray-800">Checkout</h2>

    @if ($cartItems->isEmpty())
        <div class="alert alert-info">Keranjang kamu masih kosong.</div>
        <a href="{{ route('products') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
    @else
    <div class="row">
        <div class="col-md-8">
            <!-- List Produk -->
            @foreach ($cartItems as $item)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid rounded-start" alt="{{ $item->product->name }}">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->product->name }}</h5>
                                <p class="card-text">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                                <p class="card-text"><small class="text-muted">Jumlah: {{ $item->quantity }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Form Alamat -->
            <div class="card p-4 mt-4">
                <h5>Alamat Pengiriman</h5>
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $alamat ?? '') }}</textarea>
                    </div>

                    <!-- Dropdown Wilayah -->
                    <div class="mb-3">
                        <label for="kota">Kota/Kabupaten</label>
                        <input type="text" class="form-control" name="kota" required>
                    </div>
                    <div class="mb-3">
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" class="form-control" name="kecamatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelurahan">Kelurahan</label>
                        <input type="text" class="form-control" name="kelurahan" required>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="mb-3">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select class="form-select" name="metode_pembayaran" required>
                            <option value="">Pilih metode</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="COD">Cash on Delivery</option>
                            <option value="E-Wallet">E-Wallet</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Bayar Sekarang</button>
                    <a href="{{ route('products') }}" class="btn btn-outline-secondary">Belanja Lagi</a>
                </form>
            </div>
        </div>

        <!-- Ringkasan -->
        <div class="col-md-4">
            <div class="card p-4">
                <h5>Ringkasan Pesanan</h5>
                @php $total = 0; @endphp
                @foreach ($cartItems as $item)
                    @php $total += $item->product->price * $item->quantity; @endphp
                @endforeach
                <p>Total Harga: <strong>Rp{{ number_format($total, 0, ',', '.') }}</strong></p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
