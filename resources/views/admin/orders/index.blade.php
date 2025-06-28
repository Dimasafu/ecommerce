@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pesanan</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Invoice</th>
                <th>Nama Pemesan</th>
                <th>Email</th>
                <th>Jumlah Item</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->invoice_number }}</td>
                    <td>{{ $order->user->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ $order->user->email ?? '-' }}</td>
                    <td>{{ $order->items->sum('quantity') }} item</td>
                    <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td><span class="badge bg-info">{{ ucfirst($order->status) }}</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $order->id }}">
                            Lihat Detail
                        </button>
                    </td>
                </tr>

                <!-- Modal Detail -->
                <div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Pesanan: {{ $order->invoice_number }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nama Pemesan:</strong> {{ $order->user->name }}</p>
                                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                                <p><strong>Total:</strong> Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                                <hr>
                                <h6>Barang Dipesan:</h6>
                                <ul>
                                    @foreach($order->items as $item)
                                        <li>{{ $item->product->name }} ({{ $item->quantity }}x) - Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
