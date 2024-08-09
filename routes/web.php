<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('layouts.app');
});

// Routes for category management
Route::resource('categories', CategoryController::class);

// Routes for book management
Route::resource('books', BookController::class);

// Routes for user management (optional, adjust as needed)
Route::resource('users', UserController::class);
Route::get('books/export/excel', [BookController::class, 'exportExcel'])->name('books.export.excel');
Route::get('books/export/pdf', [BookController::class, 'exportPDF'])->name('books.export.pdf');