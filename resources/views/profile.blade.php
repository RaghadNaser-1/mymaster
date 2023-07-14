@extends('layouts.master')

@section('content')
    <div class="row g-0" style="background-color: #f4623a; height: 70px;"></div>

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
                        <ul>
                            @foreach ($borrowedBooks as $borrow)
                                <li>{{ $borrow->book->title }}</li>
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
