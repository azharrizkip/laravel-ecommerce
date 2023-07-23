<!-- resources/views/admin/edit_buyer.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Pembeli</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('staff.updateBuyer', $buyer->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nama Pembeli</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $buyer->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $buyer->user->email }}" required>
                            </div>

                            <div class="form-group">
                                <label for="birth_date">Tanggal Lahir</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ $buyer->birth_date }}" required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="Male" @if($buyer->gender == 'Male') selected @endif>Male</option>
                                    <option value="Female" @if($buyer->gender == 'Female') selected @endif>Female</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" class="form-control" rows="4" required>{{ $buyer->address }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="ktp_image">Foto KTP</label>
                                <input type="file" name="ktp_image" id="ktp_image" class="form-control">
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto KTP.</small>
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('staff.manageBuyers') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
