@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($category) ? 'Edit' : 'Tambah' }} Kategori</h1>
    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
        @csrf
        @if (isset($category))
        @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Nama Kategori:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($category) ? $category->name : '' }}" required>
        </div>
        <button type="submit" class="btn btn-success">{{ isset($category) ? 'Update' : 'Simpan' }}</button>
    </form>
</div>
@endsection