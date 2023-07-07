@extends('layouts.app')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Edit Book</h1>

  <!-- Form -->
  <form action="{{ route('dashboard.books.update', ['book' => $book->id, 'dashboard' => 'dashboard']) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Title -->
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
    </div>

    <!-- Author -->
    <div class="form-group">
      <label for="author">Author</label>
      <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}" required>
    </div>

    <!-- Description -->
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" class="form-control" required>{{ $book->description }}</textarea>
    </div>

    <!-- Category -->
    <div class="form-group">
      <label for="category">Category</label>
      <select name="category" id="category" class="form-control" required>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Image -->
    <div class="form-group">
      <label for="image">Image URL</label>
      <input type="text" name="image" id="image" class="form-control" value="{{ $book->image }}" required>
    </div>

    <!-- Featured -->
    <div class="form-group">
      <label for="featured">Featured</label>
      <select name="featured" id="featured" class="form-control" required>
        <option value="0" {{ !$book->featured ? 'selected' : '' }}>No</option>
        <option value="1" {{ $book->featured ? 'selected' : '' }}>Yes</option>
      </select>
    </div>

    <!-- Quantity -->
    <div class="form-group">
      <label for="quantity">Quantity</label>
      <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $book->quantity }}" required>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Update Book</button>
  </form>
@endsection
