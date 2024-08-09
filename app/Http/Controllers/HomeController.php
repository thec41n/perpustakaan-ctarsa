<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Menghitung jumlah buku
        $booksCount = Book::count();

        // Menghitung jumlah kategori unik
        $categoriesCount = Category::count();

        $authorsCount = Book::select('author')->distinct()->count();
        $publishersCount = Book::select('publisher')->distinct()->count();

        return view('home', compact('authorsCount', 'publishersCount', 'categoriesCount', 'booksCount'));
    }
}
