<!-- resources/views/admin/edit_product.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="green-bg p-2 mb-4">Edit Produk</h1>
                <form action="{{ route('admin.editProduct', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Barang</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="product_type">Jenis Barang</label>
                        <select class="form-control" id="product_type" name="product_type" required>
                            <option value="Elektronik" {{ $product->product_type === 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                            <option value="Fashion" {{ $product->product_type === 'Fashion' ? 'selected' : '' }}>Fashion</option>
                            <option value="Makanan" {{ $product->product_type === 'Makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="Minuman" {{ $product->product_type === 'Minuman' ? 'selected' : '' }}>Minuman</option>
                            <option value="Kecantikan" {{ $product->product_type === 'Kecantikan' ? 'selected' : '' }}>Kecantikan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock Barang</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
                    </div>
                    <div class="form-group">
                        <label for="buy_price">Harga Beli</label>
                        <input type="number" class="form-control" id="buy_price" name="buy_price" value="{{ $product->buy_price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="sell_price">Harga Jual</label>
                        <input type="number" class="form-control" id="sell_price" name="sell_price" value="{{ $product->sell_price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="image_path">Gambar Barang</label>
                        <input type="file" class="form-control-file" id="image_path" name="image_path">
                        @if ($product->image_path)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->image_path }}" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
