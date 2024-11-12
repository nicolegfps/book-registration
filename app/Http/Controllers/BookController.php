<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->get('sort', 'asc');
        $books = Book::orderBy('publication_date', $sortOrder)->get();
        return view('books.index', compact('books', 'sortOrder'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|mimes:png,jpg,jpeg',
            'author' => 'required|max:255',
            'genre' => 'required|max:255',
            'publication_date' => 'required|date',
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('images', $filename, 'public');
        }

        Book::create([
            'title' => $request->title,
            'image' => 'storage/images/' . $filename,
            'author' => $request->author,
            'genre' => $request->genre,
            'publication_date' => $request->publication_date,
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'genre' => 'required|max:255',
            'publication_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('images', $filename, 'public');
            $validatedData['image'] = 'storage/images/' . $filename;
        } else {
            $validatedData['image'] = $book->image;
        }
        
        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
