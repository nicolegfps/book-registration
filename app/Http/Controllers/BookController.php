<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display books
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Show form for creating a new book
    public function create()
    {
        return view('books.create');
    }

    // Store book in the database
    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'genre' => 'required|max:255',
            'publication_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = basename($imagePath); // Store the image filename
        }

        // Create book with the validated data
        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    // Show form for editing
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Update book in the database
    public function update(Request $request, Book $book)
    {
        // Validatiom
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'genre' => 'required|max:255',
            'publication_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = basename($imagePath); // Store the image filename
        }

        // Update book with the validated data
        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Remove book
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
