@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Produk</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.addProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" required></textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product_type">Jenis Barang</label>
                                <select name="product_type" id="product_type" class="form-control @error('product_type') is-invalid @enderror" required>
                                    <option value="Elektronik">Elektronik</option>
                                    <option value="Fashion">Fashion</option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Kecantikan">Kecantikan</option>
                                </select>
                                @error('product_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock Barang</label>
                                <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" required>
                                @error('stock')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="buy_price">Harga Beli</label>
                                <input type="number" name="buy_price" id="buy_price" class="form-control @error('buy_price') is-invalid @enderror" required>
                                @error('buy_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sell_price">Harga Jual</label>
                                <input type="number" name="sell_price" id="sell_price" class="form-control @error('sell_price') is-invalid @enderror" required>
                                @error('sell_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image_path">Gambar Barang</label>
                                <input type="file" name="image_path" id="image_path" class="form-control @error('image_path') is-invalid @enderror" required>
                                @error('image_path')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Tambah Produk</button>
                                <a href="{{ route('admin.manageProducts') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
