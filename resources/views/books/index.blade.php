@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-danger">Books</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('books.create') }}" class="btn btn-danger mb-3">Add New Book</a>

        <table class="table table-striped table-bordered">
            <thead class="bg-danger text-white">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->genre }}</td>
                        <td>{{ $book->publication_date->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-danger">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
