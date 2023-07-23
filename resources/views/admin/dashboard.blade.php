<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">{{ __('Selamat datang di Dashboard Admin!') }}</div>

                <div class="card-body">
                    <h2>Menu:</h2>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a class="btn btn-success" href="{{ route('admin.manageStaff') }}">Manajemen Staff</a>
                        </li>
                        <li class="list-group-item">
                          <a class="btn btn-success" href="{{ route('admin.manageProducts') }}">Manajemen Produk</a>
                        </li>
                        <!-- Tambahkan menu lainnya sesuai kebutuhan -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
