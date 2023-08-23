@extends('layouts.master')

@section('content')
<div class="row g-0" style="background-color: #f4623a; height:70px"></div>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" ><a href="{{ route('books.index') }}">Books</a></li>
            <li class="breadcrumb-item active" ><a href="{{ route('books.show', $author->books[0]->id) }}">{{ $author->books[0]->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $author->name }}</li>


        </ol>
    </nav>
    <h1 class="author-name">{{ $author->name }}</h1>
    <hr class="divider-left" >

    <div class="author-bio">
        <h2>Biography</h2>
        @if ($author->bio)
            <p>{{ $author->bio }}</p>
        @else
            <p>No biography available.</p>
        @endif
    </div>


    <div class="author-books">
        <h2>Books by {{ $author->name }}</h2>
        <ul class="list-unstyled row">
            @foreach ($author->books as $book)
            <li class="col-md-3 mb-4">
                <div class="card book-card">
                    <a href="{{ route('books.show', $book->id) }}">
                        <img src="{{ $book->image }}" class="card-img-top book-image" alt="{{ $book->title }}">
                    </a>
                </div>
            </li>
        @endforeach

        </ul>
    </div>
</div>
<style>
    .book-image {
  width: 100%; /* Set your desired width */
  height: 450px; /* Set your desired height */
  object-fit: cover; /* Maintain aspect ratio and cover the container (use cover) */
  border-radius: 10px;
}
.divider-left {
            height: 0.2rem;
    max-width: 3.25rem;
    /* margin: 1.5rem auto; */
    background-color: #f4623a;
    opacity: 1;
        }
        .book-card {
        background-color: white;
        border: 1px solid #f2f2f2;
        /* padding: 20px; */
        border-radius: 10px;
        transition: transform 0.2s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
        .book-card:hover {
        transform: translateY(-5px);
    }
</style>


@endsection
