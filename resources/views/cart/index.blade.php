@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($cartItems as $item)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <h5>{{ $item->product->name }}</h5>
                    <p>Jumlah: {{ $item->quantity }}</p>
                    <p>Harga: Rp{{ number_format($item->product->price) }}</p>
                </div>
                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p>Keranjang masih kosong.</p>
    @endforelse

    <a href="{{ route('products') }}" class="btn btn-secondary mt-3">Belanja Lagi</a>
@endsection
