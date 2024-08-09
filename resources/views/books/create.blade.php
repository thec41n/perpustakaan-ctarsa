@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($book) ? 'Edit' : 'Tambah' }} Buku</h1>
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="title">Judul Buku:</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ isset($book) ? $book->title : '' }}" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category_id">Kategori:</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ isset($book) && $book->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="author">Penulis:</label>
                <input type="text" class="form-control" id="author" name="author"
                    value="{{ isset($book) ? $book->author : '' }}" required>
                @error('author')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="publisher">Penerbit:</label>
                <input type="text" class="form-control" id="publisher" name="publisher"
                    value="{{ isset($book) ? $book->publisher : '' }}" required>
                @error('publisher')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="year">Tahun Terbit:</label>
                <input type="text" class="form-control" id="year" name="year"
                    value="{{ isset($book) ? $book->year : '' }}" required>
                @error('year')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea class="form-control" id="description" name="description" required>{{ isset($book) ? $book->description : '' }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    value="{{ isset($book) ? $book->quantity : '' }}" required>
                @error('year')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="file_path">Upload File Buku (PDF):</label>
                <input type="file" class="form-control" id="file_path" name="file_path">
            </div>
            <div class="form-group">
                <label for="cover_image">Upload Cover Buku (Image):</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image">
            </div>
            <button type="submit" class="btn mb-2 btn-success">{{ isset($book) ? 'Update' : 'Simpan' }}</button>
        </form>
    </div>
@endsection
