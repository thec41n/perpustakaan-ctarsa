<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Barryvdh\DomPDF\PDF;
use App\Exports\BooksExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Menampilkan semua buku
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Book::with('category');

        // Mengaplikasikan pencarian jika parameter 'search' diberikan
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Hanya menampilkan buku yang sesuai dengan user yang login kecuali untuk admin
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        // Mengimplementasikan pagination
        $books = $query->paginate(10);
        $books->appends(['search' => $search]); // Menyertakan pencarian dalam link pagination

        return view('books.index', [
            'books' => $books,
            'totalPages' => $books->lastPage(), // Mendapatkan jumlah total halaman
            'page' => $books->currentPage() // Mendapatkan halaman saat ini
        ]);
    }

    // Menampilkan form untuk membuat buku baru
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // Menyimpan buku baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'quantity' => 'required|integer',
            'file_path' => 'required|file',
            'cover_image' => 'required|image'
        ]);

        $book = new Book($request->except(['file_path', 'cover_image']));
        if ($request->hasFile('file_path')) {
            $book->file_path = $request->file('file_path')->store('pdfs', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $book->cover_image = $request->file('cover_image')->store('covers', 'public');
        }
        $book->user_id = auth()->id();
        $book->save();

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit buku
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $this->authorize('update', $book);

        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // Memperbarui buku di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'quantity' => 'required|integer'
        ]);

        $book = Book::findOrFail($id);
        if ($request->hasFile('file_path')) {
            Storage::delete('public/' . $book->file_path);
            $book->file_path = $request->file('file_path')->store('pdfs', 'public');
        }
        if ($request->hasFile('cover_image')) {
            Storage::delete('public/' . $book->cover_image);
            $book->cover_image = $request->file('cover_image')->store('covers', 'public');
        }
        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $this->authorize('delete', $book);

        Storage::delete(['public/' . $book->file_path, 'public/' . $book->cover_image]);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }

    public function exportPDF(PDF $pdf)
    {
        $books = Auth::user()->role === 'admin' ? Book::all() : Auth::user()->books;

        // HTML content
        $html = view('books.pdf', compact('books'))->render();

        // Memuat HTML ke PDF
        $pdf = $pdf->loadHTML($html);
        return $pdf->download('books.pdf');
    }
}
