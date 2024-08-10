@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Buku</h1>
        <div class="mb-2">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku</a>
            <a href="{{ route('books.export.excel') }}" class="btn btn-success">Ekspor ke Excel</a>
            <a href="{{ route('books.export.pdf') }}" class="btn btn-danger">Ekspor ke PDF</a>
            <form action="{{ route('books.index') }}" method="GET" class="mb-4">
                <div class="input-group mt-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari buku..."
                        value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Cover</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($books->count() > 0)
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->category->name }}</td>
                            <td>{{ $book->author }}</td>
                            <td>
                                <a href="#viewImageModal{{ $book->id }}" data-toggle="modal"
                                    data-target="#viewImageModal{{ $book->id }}"
                                    data-image="{{ asset('storage/' . $book->cover_image) }}">
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover"
                                        style="width: 100px; height: auto;">
                                </a>
                            </td>
                            <td>
                                @can('update', $book)
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info">Edit</a>
                                @endcan
                                @can('delete', $book)
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        <div class="modal fade" id="viewImageModal{{ $book->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="viewImageModalLabel{{ $book->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewImageModalLabel{{ $book->id }}">Gambar Cover
                                            Buku</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="modalImage{{ $book->id }}"
                                            src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover"
                                            style="max-width: 100%; max-height: 600px; width: auto; height: auto;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">Tidak ada buku tersedia.</td>
                    </tr>
                @endif

            </tbody>
        </table>
        <!-- Pagination -->

        <div class="pagination">
            @if ($page > 1)
                <a href="{{ route('books.index', ['page' => $page - 1]) }}">&laquo; Previous</a>
            @endif

            @for ($i = 1; $i <= $totalPages; $i++)
                <a href="{{ route('books.index', ['page' => $i]) }}"
                    class="{{ $i == $page ? 'active' : '' }}">{{ $i }}</a>
            @endfor

            @if ($page < $totalPages)
                <a href="{{ route('books.index', ['page' => $page + 1]) }}">Next &raquo;</a>
            @endif
        </div>

    </div>
@endsection
