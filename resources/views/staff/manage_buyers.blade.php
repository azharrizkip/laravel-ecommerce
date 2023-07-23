<!-- resources/views/admin/manage_buyers.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="green-bg p-2 mb-4">Manajemen Pembeli</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2>Daftar Pembeli:</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Pembeli</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buyers as $buyer)
                            <tr>
                                <td>{{ $buyer->name }}</td>
                                <td>{{ $buyer->user->email }}</td> <!-- Menampilkan email dari relasi user -->
                                <td>{{ $buyer->gender }}</td>
                                <td>{{ $buyer->address }}</td>
                                <td>{{ $buyer->birth_date }}</td>
                                <td>
                                    <a href="{{ route('staff.editBuyer', $buyer->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('staff.deleteBuyer', $buyer->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pembeli ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $buyers->links() }}
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <a class="btn btn-primary" href="{{ route('staff.createBuyer') }}">Tambah Pembeli</a>
            </div>
        </div>
    </div>
@endsection
