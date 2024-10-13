<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display a listing of the books
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Show the form for creating a new book
    public function create()
    {
        return view('books.create');
    }

    // Store a newly created book in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|max:255',               // Title is required and max 255 characters
            'author' => 'required|max:255',              // Author is required and max 255 characters
            'genre' => 'required|max:255',                // Genre is required and max 255 characters
            'publication_date' => 'required|date',       // Publication date is required and must be a valid date
        ]);

        // Create a new book using the validated data
        Book::create($request->all());

        // Redirect back to the books list with a success message
        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    // Show the form for editing a specific book
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Update the specified book in the database
    public function update(Request $request, Book $book)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|max:255',               // Title is required and max 255 characters
            'author' => 'required|max:255',              // Author is required and max 255 characters
            'genre' => 'required|max:255',                // Genre is required and max 255 characters
            'publication_date' => 'required|date',       // Publication date is required and must be a valid date
        ]);

        // Update the book with the validated data
        $book->update($request->all());

        // Redirect back to the books list with a success message
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Remove the specified book from the database
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
