<!-- resources/views/admin/edit_staff.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="green-bg p-2 mb-4">Edit Staff</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.editStaff', $staff->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $staff->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin:</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male" {{ $staff->gender == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Female" {{ $staff->gender == 'Female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $staff->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Retype Password:</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-green">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
