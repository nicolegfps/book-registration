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

        <form action="{{ route('books.update', $book) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}">
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}">
            </div>

            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" class="form-control" id="genre" name="genre" value="{{ $book->genre }}">
            </div>

            <div class="form-group">
                <label for="publication_date">Publication Date:</label>
                <input type="date" class="form-control" id="publication_date" name="publication_date" value="{{ $book->publication_date->format('Y-m-d') }}">
            </div>

            <button type="submit" class="btn btn-success">Update Book</button>
        </form>
    </div>
@endsection
