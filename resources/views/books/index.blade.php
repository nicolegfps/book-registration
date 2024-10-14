@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-danger">eBooks</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('books.create') }}" class="btn btn-danger mb-3">Add New Book</a>


    <table class="table table-striped table-bordered">
        <thead class="bg-danger text-white">
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>
                    Publication Date
                    <!-- Add sorting links in the header -->
                    <a href="{{ route('books.index', ['sort' => 'asc']) }}" class="{{ $sortOrder === 'asc' ? 'active' : '' }}">↑</a>
                    <a href="{{ route('books.index', ['sort' => 'desc']) }}" class="{{ $sortOrder === 'desc' ? 'active' : '' }}">↓</a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>
                        @if($book->image) <!-- Check if the image exists -->
                            <img src="{{ asset('storage/images/' . $book->image) }}" alt="Book Image" style="width: 100px; height: auto;"> <!-- Display the image -->
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>{{ \Carbon\Carbon::parse($book->publication_date)->format('Y-m-d') }}</td>
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
