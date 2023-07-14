@extends('layouts.master')

@section('content')
<div class="row g-0" style="background-color: #f4623a; height:70px"></div>

    <div class="container-fluid px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-10 text-center mt-4">
                <h1 class="mt-0">Books</h1>
                <hr class="divider" />

                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-4">
                            <form class="form-inline" action="{{ route('books.index') }}" method="GET">
                                <div class="input-group">
                                    <input class="form-control" type="search" placeholder="Search by book title, author name" aria-label="Search" name="search">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="{{ route('books.index') }}" class="category-link">All Categories</a>
                                </li>

                                @foreach($categories as $category)
                                    <li class="list-group-item">
                                        <a href="{{ route('books.index', ['category' => $category->id]) }}" class="category-link">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        {{-- <div class="row row-cols-3 g-3"> --}}
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">

                            @foreach ($books as $book)
                                <div class="col mb-4">
                                    <div class="card book-card">
                                        <div class="book-image">
                                            <a href="{{ route('books.show', $book) }}">
                                                @if ($book->image)
                                                    <img src="{{ $book->image }}" class="card-img-top" alt="{{ $book->title }}">
                                                @else
                                                    <div class="card-img-top placeholder-image"></div>
                                                @endif
                                            </a>
                                            <div class="book-overlay">
                                                <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Pagination links -->
                {{-- <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="pagination justify-content-center">
                            {{ $books->links() }}
                        </ul>
                    </div>
                </div> --}}

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
            height: 400px;
        }

        .book-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .book-image {
            position: relative;
            overflow: hidden;
            height: 400px;
        }

        .book-image .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .card-img-top.placeholder-image {
            background-color: #ddd;
        }

        .book-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .book-card:hover .book-overlay {
            opacity: 1;
        }

        .book-overlay a {
            color: #fff;
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

        .pagination {
            margin-top: 20px;
        }
        .category-link {
    color: #333;
    text-decoration: none;
    font-weight: bold;
}

.category-link:hover {
    /* text-decoration: underline; */
}

    </style>
@endsection
