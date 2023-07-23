<!-- resources/views/buyer/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row mt-3">
        <div class="col">
            <h2>Daftar Produk:</h2>
            <div class="row row-cols-2 row-cols-md-3 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card">
                            <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top img-fluid" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Deskripsi: {{ $product->description }}</p>
                                <p class="card-text">Harga: {{ 'Rp ' . number_format($product->sell_price, 0, ',', '.') }}</p>
                                <!-- Tambahkan tombol "Tambah ke Keranjang" -->
                                <form action="{{ route('buyer.addToCart', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                                </form>

                                <!-- Tambahkan tombol "Kurangi dari Keranjang" -->
                                <form action="{{ route('buyer.removeFromCart', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Kurangi dari Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Tampilkan pagination links -->
            <div class="d-flex justify-content-center mt-3">
              {{ $products->links() }}
            </div>
        </div>
    </div>
    @if (session('cart'))
        <div class="row mt-3">
            <div class="col">
                <h2>Keranjang Belanja:</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('cart') as $productId => $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ isset($item['quantity']) ? $item['quantity'] : 1 }}</td>
                                <td>{{ isset($item['price']) ? 'Rp ' . number_format($item['price'], 0, ',', '.') : 'Harga tidak tersedia' }}</td>
                                <td>{{ isset($item['total']) ? 'Rp ' . number_format($item['total'], 0, ',', '.') : 'Total tidak tersedia' }}</td>
                                <td>
                                    <form action="{{ route('buyer.removeFromCart', $productId) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
