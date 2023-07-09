<!-- resources/views/profile.blade.php -->

@extends('layouts.master')

@section('content')
<div class="row g-0" style="background-color: #f4623a; height: 70px;"></div>

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 text-center mt-4 mb-4">
                <h1 class="mt-0">User Profile</h1>
                <hr class="divider" />

                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">Email: {{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-4">
                    <h1>Borrowed Books</h1>

                    @if ($borrowedBooks->isEmpty())
                        <p>No books borrowed.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($borrowedBooks as $borrow)
                                <li class="list-group-item">{{ $borrow->book->title }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>
        .divider {
            width: 100px;
            border-top: 2px solid #555;
            margin: 20px auto;
        }

        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
        }

        .list-group-item {
            background-color: #f9f9f9;
            border: none;
            border-radius: 0;
        }
    </style>
@endsection


