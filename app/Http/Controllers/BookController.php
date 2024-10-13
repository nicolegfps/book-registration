<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display a listing of the books
    public function index()
    {
        // Fetch all books from the database
        $books = Book::all();

        // Pass the books data to the index view
        return view('books.index', compact('books'));
    }

    // Show the form for creating a new book
    public function create()
    {
        // Return the view with the form to add a new book
        return view('books.create');
    }

    // Store a newly created book in the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'genre' => 'required|max:255',
            'publication_date' => 'required|date',
        ]);

        // Create a new book using the form data
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'publication_date' => $request->publication_date,
        ]);

        // Redirect to the books list with a success message
        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    // Show the form for editing a specific book
    public function edit(Book $book)
    {
        // Return the view with the form to edit the book
        return view('books.edit', compact('book'));
    }

    // Update the specified book in the database
    public function update(Request $request, Book $book)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'genre' => 'required|max:255',
            'publication_date' => 'required|date',
        ]);

        // Update the book with the new data
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'publication_date' => $request->publication_date,
        ]);

        // Redirect to the books list with a success message
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Remove the specified book from the database
    public function destroy(Book $book)
    {
        // Delete the book
        $book->delete();

        // Redirect to the books list with a success message
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
