@extends('layouts.master')

@section('content')
    <div class="container-fluid px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-10 text-center mt-4">
                <h1 class="mt-0">Books</h1>
                <hr class="divider" />

                <div class="row mb-4">
                    <div class="col-md-8 offset-md-2">
                        <form class="form-inline" action="{{ route('books.index') }}" method="GET">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="Search books" aria-label="Search" name="search">
                                <select class="form-control mr-sm-2" name="category">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <div class="input-group-append"> --}}
                                    <button class="btn btn-primary" type="submit">Search</button>
                                {{-- </div> --}}
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row row-cols-4 g-4">
                    @foreach ($books as $book)
                        <div class="col mb-4">
                            <div class="card book-card">
                                <div class="book-image">
                                    @if ($book->image)
                                        <img src="{{ $book->image }}" class="card-img-top" alt="{{ $book->title }}">
                                    @else
                                        <div class="card-img-top placeholder-image"></div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text">Author: {{ $book->author }}</p>
                                    <p class="card-text">Category: {{ $book->category->name }}</p>
                                    <p class="card-text">{{ $book->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .container-fluid {
            padding: 0;
        }

        .book-card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s;
            height: 100%;
        }

        .book-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .book-image {
            position: relative;
            overflow: hidden;
            height: 500px;
        }

        .book-image .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .card-img-top.placeholder-image {
            background-color: #ddd;
        }

        .card-body {
            background-color: #f9f9f9;
            padding: 15px;
            height: 100%;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-text {
            margin-bottom: 10px;
        }
    </style>
@endsection
