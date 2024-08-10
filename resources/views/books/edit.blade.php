@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Buku</h1>

        <!-- Form untuk update buku -->
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Buku:</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $book->title) }}" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Kategori:</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
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
                <input type="text" class="form-control" id="author" name="author"
                    value="{{ old('author', $book->author) }}" required>
                @error('author')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="publisher">Penerbit:</label>
                <input type="text" class="form-control" id="publisher" name="publisher"
                    value="{{ old('publisher', $book->publisher) }}" required>
                @error('publisher')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="year">Tahun Terbit:</label>
                <input type="text" class="form-control" id="year" name="year"
                    value="{{ old('year', $book->year) }}" required>
                @error('year')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    value="{{ old('quantity', $book->quantity) }}" required>
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="file_path">Upload File Buku (PDF):</label>
                <input type="file" class="form-control" id="file_path" name="file_path">
                @if ($book->file_path)
                    <p>Current file: <a href="{{ asset('storage/' . $book->file_path) }}"
                            target="_blank">{{ $book->file_path }}</a></p>
                @endif
                @error('file_path')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="cover_image">Upload Cover Buku (Image):</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image">
                @if ($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover"
                        style="width: 100px; height: auto;">
                @endif
                @error('cover_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="col-auto">
                    <button type="submit" class="btn mb-2 btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
