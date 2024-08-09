@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buku</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku</a>
    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->category->name }}</td>
                <td>{{ $book->author }}</td>
                <td>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection