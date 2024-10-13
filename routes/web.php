<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Route for the homepage (redirecting to books index)
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Book routes for CRUD functionality
Route::get('/books', [BookController::class, 'index'])->name('books.index');     // Show all books
Route::get('/books/create', [BookController::class, 'create'])->name('books.create'); // Show form to create a new book
Route::post('/books', [BookController::class, 'store'])->name('books.store');   // Handle form submission and save new book
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');  // Show form to edit a book
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');   // Handle form submission to update a book
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy'); // Delete a book

// You can add authentication routes here if needed for login, registration, etc.
// Example: Auth::routes(); (For Laravel's built-in authentication routes)
