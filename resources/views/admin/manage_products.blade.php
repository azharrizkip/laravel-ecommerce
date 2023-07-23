<!-- resources/views/admin/manage_products.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h1 class="green-bg p-2 mb-4">Manajemen Produk</h1>
                    <a href="{{ route('admin.addProduct') }}" class="btn btn-primary float-right">Tambah Produk</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Jenis Barang</th>
                                <th>Stock Barang</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->product_type }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>Rp {{ number_format($product->buy_price, 2, ',', '.') }}</td>
                                <td>Rp {{ number_format($product->sell_price, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.editProduct', ['id' => $product->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.deleteProduct', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
