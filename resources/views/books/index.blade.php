@extends('layouts.master')

@section('content')
    <h1>Books</h1>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach ($books as $book)
            <div class="col">
                <div class="card h-100">
                    <div class="book-image">
                        @if ($book->image)
                            <img src="{{ $book->image }}" class="card-img-top" alt="{{ $book->title }}">
                        @endif
                        <div class="card-overlay">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">Author: {{ $book->author }}</p>
                            <p class="card-text">Description: {{ $book->description }}</p>
                            <p class="card-text">Category: {{ $book->category->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .book-image {
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .book-image .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 100%;
            transition: opacity 0.3s;
        }

        .book-image:hover .card-img-top {
            opacity: 0.5;
        }

        .book-image .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .book-image:hover .card-overlay {
            opacity: 1;
        }

        .card-overlay h5,
        .card-overlay p {
            margin: 0;
            padding: 5px;
        }
    </style>
@endsection
