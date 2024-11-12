@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div style="display: flex; justify-content: center; width: 100%;">
        <img src="storage/images/e-books-logo.png" alt="eBooks Logo" style="max-width: 350px; height: auto;">
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('books.create') }}" class="btn btn-danger btn-lg">Add New Book</a>
        <div>
            <a href="{{ route('books.index', ['sort' => 'asc']) }}" class="btn btn-outline-danger btn-sm {{ $sortOrder === 'asc' ? 'active' : '' }}">Sort Asc ↑</a>
            <a href="{{ route('books.index', ['sort' => 'desc']) }}" class="btn btn-outline-danger btn-sm {{ $sortOrder === 'desc' ? 'active' : '' }}">Sort Desc ↓</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-danger text-white">
                <tr>
                    <th>Image</th>
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
                    <td class="text-center">
                        @if($book->image && file_exists(public_path('storage/images/' . basename($book->image))))
                        <img src="{{ asset('storage/images/' . basename($book->image)) }}" alt="{{ $book->title }}" class="img-fluid" style="max-width: 120px; height: auto;">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>{{ \Carbon\Carbon::parse($book->publication_date)->format('Y-m-d') }}</td>
                    <td class="justify-content-center">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-danger btn-sm mr-2">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection