<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::patch('/profile', [UserController::class, 'update'])->name('profile.update')->middleware('auth');

// Routes for category management
Route::resource('categories', CategoryController::class)->middleware('auth');

// Routes for book management
Route::resource('books', BookController::class)->middleware('auth');

// Routes for user management (optional, adjust as needed)
Route::resource('users', UserController::class)->middleware('auth');
Route::get('books/export/excel', [BookController::class, 'exportExcel'])->name('books.export.excel')->middleware('auth');
Route::get('books/export/pdf', [BookController::class, 'exportPDF'])->name('books.export.pdf')->middleware('auth');
