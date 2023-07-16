@extends('layouts.master')

@section('content')
    <div class="row g-0" style="background-color: #f4623a; height: 70px;"></div>
<!-- profile.blade.php -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="container mt-4 ">
        <div class="card">
            <div class="card-body">
                <div class="profile-info">
                    <h2>{{ $user->name }}</h2>
                    <p>Email: {{ $user->email }}</p>
                </div>
                <hr class="divider-left" >

                {{-- <div class="row">
                    <div class="col-md-6 offset-md-3">

                    </div>
                </div> --}}

                <div class="borrowed-books">
                    <h2>Borrowed Books</h2>
                    @if ($borrowedBooks->isEmpty())
                        <p>No books borrowed.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($borrowedBooks as $borrow)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                    <i class="fas fa-book"></i>
                                    <a href="{{ route('books.show', $borrow->book->id) }}">{{ $borrow->book->title }}</a>
                                    <span>- Due Date: {{ $borrow->estimated_end_time }}</span>
                                        </div>
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('books.renew', $borrow->id) }}" class="btn btn-primary">Renew</a>

                                        <a href="{{ route('borrows.return', $borrow) }}" class="btn btn-primary">Return</a>

                                    </div>
                                    </div>
                                    {{-- <form action="{{ route('books.renew', $borrow->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Renew</button>
                                    </form> --}}


                                    {{-- <a href="{{ route('books.favorite', $borrow->book) }}" class="btn btn-primary"><i class="fas fa-heart"></i> Add to Favorites</a> --}}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="favorite-books mt-4">
                    <h2>Favorite Books</h2>
                    @if ($favoriteBooks->isEmpty())
                        <p>No favorite books selected.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($favoriteBooks as $favorite)
                                <li class="list-group-item">
                                    <i class="fas fa-book"></i>
                                    <a href="{{ route('books.show', $favorite->id) }}">{{ $favorite->title }}</a>
                                    <a href="{{ route('books.unfavorite', $favorite) }}" class="btn btn-danger"><i class="fas fa-heart"></i> Remove from Favorites</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="borrow-history mt-4">
                    <h2 class="mb-4">Borrowing History</h2>
                    @if ($borrows->isEmpty())
                        <p>No borrowing history found.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($borrows as $borrow)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Book: <a href="{{ route('books.show', $borrow->book->id) }}">{{ $borrow->book->title }}</a></h5>
                                            <p class="mb-0">Borrowed At: {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('Y-m-d') }}</p>
                                            <p>Returned: {{ $borrow->returned ? 'Yes' : 'No' }}</p>
                                        </div>

                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>


            </div>
        </div>
    </div>
    <style>
        /* Custom styling */
        .divider-left {
            height: 0.2rem;
    max-width: 3.25rem;
    /* margin: 1.5rem auto; */
    background-color: #f4623a;
    opacity: 1;
        }
    </style>
@endsection
