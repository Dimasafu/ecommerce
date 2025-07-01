@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Kelola Produk</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Produk</button>

    <!-- Modal Tambah -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Produk</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Harga</label>
                            <input type="text" name="price" class="form-control" id="priceInput" required oninput="formatRupiah(this)">
                            <script>
                            function formatRupiah(input) {
                                let value = input.value.replace(/[^,\d]/g, '').toString();
                                let split = value.split(',');
                                let sisa = split[0].length % 3;
                                let rupiah = split[0].substr(0, sisa);
                                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                if (ribuan) {
                                    let separator = sisa ? '.' : '';
                                    rupiah += separator + ribuan.join('.');
                                }

                                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                                input.value = rupiah ? 'Rp' + rupiah : '';
                            }
                            </script>
                        </div>
                        <div class="mb-3">
                            <label>Stok</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Gambar</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Produk -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="" width="60">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">Edit</button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">Hapus</button>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1">
              <div class="modal-dialog">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Produk</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Harga</label>
                            <input type="text" name="price" class="form-control" id="priceInput" required oninput="formatRupiah(this)">
                            <script>
                            function formatRupiah(input) {
                                let value = input.value.replace(/[^,\d]/g, '').toString();
                                let split = value.split(',');
                                let sisa = split[0].length % 3;
                                let rupiah = split[0].substr(0, sisa);
                                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                if (ribuan) {
                                    let separator = sisa ? '.' : '';
                                    rupiah += separator + ribuan.join('.');
                                }

                                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                                input.value = rupiah ? 'Rp' + rupiah : '';
                            }</script>
                        </div>
                        <div class="mb-3">
                            <label>Stok</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="category_id" class="form-control" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Gambar</label>
                            <input type="file" name="image" class="form-control">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" width="80" class="mt-2">
                            @endif
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>

            <!-- Modal Hapus -->
            <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1">
              <div class="modal-dialog">
                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Hapus Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <p>Yakin ingin menghapus produk <strong>{{ $product->name }}</strong>?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
