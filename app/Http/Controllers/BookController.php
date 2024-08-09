<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Barryvdh\DomPDF\PDF;
use App\Exports\BooksExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $books = Book::with('category')->get();
        return view('books.index', compact('books'));
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

        $book = new Book($request->all());
        if ($request->hasFile('file_path')) {
            $book->file_path = $request->file('file_path')->store('pdfs', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $book->cover_image = $request->file('cover_image')->store('covers', 'public');
        }
        $book->save();

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit buku
    public function edit($id)
    {
        $book = Book::findOrFail($id);
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
            // Delete old file
            Storage::delete('public/' . $book->file_path);
            // Upload new file
            $book->file_path = $request->file('file_path')->store('pdfs', 'public');
        }
        if ($request->hasFile('cover_image')) {
            // Delete old image
            Storage::delete('public/' . $book->cover_image);
            // Upload new image
            $book->cover_image = $request->file('cover_image')->store('covers', 'public');
        }
        $book->update($request->all());

        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }

    public function exportPDF()
    {
        $books = Book::all();
        $pdf = PDF::loadView('books.pdf', compact('books'));
        return $pdf->download('books.pdf');
    }
}
