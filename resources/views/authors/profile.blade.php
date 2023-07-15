@extends('layouts.master')

@section('content')
<div class="row g-0" style="background-color: #f4623a; height:70px"></div>

<div class="container mt-4">
    <h1 class="author-name">{{ $author->name }}</h1>
    <hr class="divider-left" >

    <div class="author-bio">
        <h2>Biography:</h2>
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
                <li class="col-md-3">
                    <div class="card">
                        <a href="{{ route('books.show', $book->id) }}">
                            <img src="{{ $book->image }}" class="card-img-top book-image" alt="{{ $book->title }}" >
                        </a>
                                                {{-- <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">Author: {{ $book->author }}</p>
                            <p class="card-text">Description: {{ $book->description }}</p>
                            <p class="card-text">Category: {{ $book->category->name }}</p>
                        </div> --}}
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
  object-fit: fill; /* Maintain aspect ratio and cover the container (use cover) */
}
.divider-left {
            height: 0.2rem;
    max-width: 3.25rem;
    /* margin: 1.5rem auto; */
    background-color: #f4623a;
    opacity: 1;
        }
</style>


@endsection
