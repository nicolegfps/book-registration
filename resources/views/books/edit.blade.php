@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Book</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mt-4">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}">
        </div>

        <div class="form-group mt-4">
            <label for="author">Author:</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $book->author) }}">
        </div>

        <div class="form-group mt-4">
            <label for="genre">Genre:</label>
            <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $book->genre) }}">
        </div>

        <div class="form-group mt-4">
            <label for="publication_date">Publication Date:</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date"
                value="{{ old('publication_date', $book->publication_date->format('Y-m-d')) }}">
        </div>

        <div class="form-group mt-4">
            <label for="image">Book Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-4">Update Book</button>
    </form>
</div>
@endsection