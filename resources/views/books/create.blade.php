@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Buku</h1>
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Judul Buku:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category_id">Kategori:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="author">Penulis:</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}"
                    required>
                @error('author')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="publisher">Penerbit:</label>
                <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher') }}"
                    required>
                @error('publisher')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="year">Tahun Terbit:</label>
                <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}"
                    required>
                @error('year')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}"
                    required>
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="file_path">Upload File Buku (PDF):</label>
                <input type="file" class="form-control" id="file_path" name="file_path" required>
                @error('file_path')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="cover_image">Upload Cover Buku (Image):</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image" required>
                @error('cover_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn mb-2 btn-success">Simpan</button>
        </form>
    </div>
@endsection
