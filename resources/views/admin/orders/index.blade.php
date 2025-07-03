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
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->invoice_number }}</td>
                        <td>{{ $order->user->name ?? 'User tidak ditemukan' }}</td>
                        <td>{{ $order->user->email ?? '-' }}</td>
                        <td>{{ $order->items->sum('quantity') }} item</td>
                        <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td><span class="badge bg-info">{{ ucfirst($order->status) }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#updateModal{{ $order->id }}">
                                Update
                            </button>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $order->id }}">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Update Status -->
                    <div class="modal fade" id="updateModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title">Update Status - {{ $order->invoice_number }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="status" class="form-label"><strong>Status Pembayaran</strong></label>
                                        <select name="status" class="form-select">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="processing"
                                                {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="packing" {{ $order->status == 'packing' ? 'selected' : '' }}>
                                                Packing</option>
                                            <option value="on delivery"
                                                {{ $order->status == 'on delivery' ? 'selected' : '' }}>On Delivery
                                            </option>
                                            <option value="success" {{ $order->status == 'success' ? 'selected' : '' }}>
                                                Success</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal Detail Pesanan -->
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
