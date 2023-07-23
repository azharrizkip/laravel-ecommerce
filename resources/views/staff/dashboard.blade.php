@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="green-bg p-2 mb-4">Selamat datang di Dashboard Staff!</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2>Menu:</h2>
                <ul>
                    <li><a class="btn btn-green" href="{{ route('staff.manageProducts') }}">Manajemen Produk</a></li>
                    <li><a class="btn btn-green" href="{{ route('staff.manageBuyers') }}">Manajemen Buyer</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
