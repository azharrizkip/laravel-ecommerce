<!-- resources/views/admin/manage_staff.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="green-bg p-2 mb-4">Manajemen Staff</h1>
            </div>
        </div>

         <!-- Tambahkan tombol "Add Staff" di sini -->
        <div class="row mb-3">
          <div class="col-12">
              <a href="{{ route('admin.addStaffForm') }}" class="btn btn-green">Add Staff</a>
          </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2>Daftar Staff:</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table">
                    <thead class="green-bg">
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Action</th>
                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff as $staff)
                            <tr>
                                <td>{{ $staff->name }}</td>
                                <td>{{ $staff->gender }}</td>
                                <td>{{ $staff->email }}</td>
                                <td>
                                  <a href="{{ route('admin.editStaffForm', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                  <form action="{{ route('admin.deleteStaff', $staff->id) }}" method="POST" class="d-inline">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus staff ini?')">Hapus</button>
                                  </form>
                                </td>
                                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
