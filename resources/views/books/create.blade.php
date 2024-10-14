@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Book</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-3">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>

        <div class="form-group mt-3">
            <label for="author">Author:</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">
        </div>

        <div class="form-group mt-3">
            <label for="genre">Genre:</label>
            <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre') }}">
        </div>

        <div class="form-group mt-3">
            <label for="publication_date">Publication Date:</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date"
                value="{{ old('publication_date') }}">
        </div>

        <div class="form-group mt-3">
            <label for="image">Book Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-4">Add Book</button>
    </form>

</div>
@endsection
