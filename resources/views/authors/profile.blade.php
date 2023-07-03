@extends('layouts.master')

@section('content')

<div class="container mt-4">
    <h1 class="author-name">{{ $author->name }}</h1>

    <div class="author-bio">
        <h2>Biography:</h2>
        <p>{{ $author->bio }}</p>
    </div>

    <div class="author-books">
        <h2>Books by {{ $author->name }}</h2>
        <ul class="list-unstyled row">
            @foreach ($author->books as $book)
                <li class="col-md-3">
                    <div class="card">
                        <img src="{{ $book->image }}" class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">Author: {{ $book->author }}</p>
                            <p class="card-text">Description: {{ $book->description }}</p>
                            <p class="card-text">Category: {{ $book->category->name }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>



@endsection
