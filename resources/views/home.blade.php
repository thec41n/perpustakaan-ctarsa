@extends('layouts.app')

@section('content')
<div class="row text-center">
    <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h2 class="card-title">{{ $authorsCount }}</h2>
                <p class="card-text">Penulis Terdaftar</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h2 class="card-title">{{ $publishersCount }}</h2>
                <p class="card-text">Penerbit Terdaftar</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h2 class="card-title">{{ $categoriesCount }}</h2>
                <p class="card-text">Kategori Terdaftar</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h2 class="card-title">{{ $booksCount }}</h2>
                <p class="card-text">Buku Terdaftar</p>
            </div>
        </div>
    </div>
</div>
@endsection