<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('books.index');
});

// Book routes for CRUD
Route::get('/books', [BookController::class, 'index'])->name('books.index');     // Display book list
Route::get('/books/create', [BookController::class, 'create'])->name('books.create'); // Shows form
Route::post('/books', [BookController::class, 'store'])->name('books.store');   // Handles form
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');  // Edit
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');   // Update
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy'); // Delete

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
