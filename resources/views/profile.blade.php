@extends('layouts.master')

@section('content')
    <div class="row g-0" style="background-color: #f4623a; height: 70px;"></div>
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
                <hr class="divider-left">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="borrowed-books-tab" data-toggle="tab" href="#borrowed-books" role="tab" aria-controls="borrowed-books" aria-selected="true">Borrowed Books</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="favorite-books-tab" data-toggle="tab" href="#favorite-books" role="tab" aria-controls="favorite-books" aria-selected="false">Favorite Books</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="borrow-history-tab" data-toggle="tab" href="#borrow-history" role="tab" aria-controls="borrow-history" aria-selected="false">Borrowing History</a>
                    </li>
                </ul>
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="borrowed-books" role="tabpanel" aria-labelledby="borrowed-books-tab">
                        <!-- Content for Borrowed Books tab -->
                        @if ($borrowedBooks->isEmpty())
                            <p>No books borrowed.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($borrowedBooks as $borrow)
                                    <li class="list-group-item">
                                        <!-- Your code for displaying borrowed books -->
                                        <div class="row">
                                            <div class="col-md-6">
                                        <i class="fas fa-book"></i>
                                        <a href="{{ route('books.show', $borrow->book->id) }}">{{ $borrow->book->title }}</a>
                                        <span>- Due Date: {{ $borrow->estimated_end_time }}</span>
                                            </div>
                                        <div class="col-md-6 text-right">
                                            {{-- <a href="{{ route('books.renew', $borrow->id) }}" class="btn btn-primary">Renew</a> --}}
                                            <a href="{{ route('books.renew', $borrow->id) }}" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i> Renew
                                            </a>
                                            <a href="{{ route('borrows.return', $borrow) }}" class="btn btn-danger">
                                                <i class="fas fa-arrow-left"></i> Return
                                            </a>

                                            {{-- <a href="{{ route('borrows.return', $borrow) }}" class="btn btn-primary">Return</a> --}}

                                        </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="favorite-books" role="tabpanel" aria-labelledby="favorite-books-tab">
                        <!-- Content for Favorite Books tab -->
                        @if ($favoriteBooks->isEmpty())
                            <p>No favorite books selected.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($favoriteBooks as $favorite)
                                    <li class="list-group-item">
                                        <!-- Your code for displaying favorite books -->
                                        <div class="row">
                                        <div class="col-md-6">
                                        <i class="fas fa-book"></i>
                                        <a href="{{ route('books.show', $favorite->id) }}">{{ $favorite->title }}</a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                        <a href="{{ route('books.unfavorite', $favorite) }}" class="btn btn-danger"><i class="fas fa-heart-broken"></i> Remove </a>
                                        </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="borrow-history" role="tabpanel" aria-labelledby="borrow-history-tab">
                        <!-- Content for Borrowing History tab -->
                        @if ($borrows->isEmpty())
                            <p>No borrowing history found.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($borrows as $borrow)
                                    <li class="list-group-item">
                                        <!-- Your code for displaying borrowing history -->
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
