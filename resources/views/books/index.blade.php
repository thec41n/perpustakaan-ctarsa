@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Buku</h1>
        <div class="mb-2">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku</a>
            <a href="{{ route('books.export.excel') }}" class="btn btn-success">Ekspor ke Excel</a>
            <a href="{{ route('books.export.pdf') }}" class="btn btn-danger">Ekspor ke PDF</a>
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
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            <a href="#viewImageModal" data-toggle="modal" data-target="#viewImageModal"
                                data-image="{{ asset('storage/' . $book->cover_image) }}">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover"
                                    style="width: 100px; height: auto;">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="viewImageModal" tabindex="-1" role="dialog" aria-labelledby="viewImageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewImageModalLabel">Gambar Cover Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src=""
                            style="max-width: 100%; max-height: 600px; width: auto; height: auto;" alt="Cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    $('#viewImageModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var imageUrl = button.data('image');
        var modal = $(this);
        modal.find('#modalImage').attr('src', imageUrl);
    });
</script>
