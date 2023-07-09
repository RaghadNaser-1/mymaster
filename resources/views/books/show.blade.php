@extends('layouts.master')

@section('content')
    <div class="row g-0" style="background-color: #f4623a; height: 70px;"></div>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-3">
                    <img src="{{ $book->image }}" class="card-img" alt="{{ $book->title }}" width="350" height="500">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">Author: {{ $book->author }}</p>
                        <p class="card-text">Category: {{ $book->category->name }}</p>
                        <p class="card-text">{{ $book->description }}</p>
                        <button class="btn btn-primary" id="borrowButton">Borrow</button>
                        <!-- Modal -->
                        <div class="modal fade" id="borrowModal" tabindex="-1" role="dialog" aria-labelledby="borrowModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="borrowModalLabel">Borrow Book</h5>
                                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button> --}}
                                    </div>
                                    <div class="modal-body">
                                        @auth
                                            <p>Are you sure you want to borrow this book?</p>
                                            <form action="{{ route('books.borrow', $book) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Borrow</button>
                                            </form>
                                        @else
                                            <p>You should <a href="{{ route('login') }}">login</a> to borrow this book.</p>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show the borrow modal when the borrow button is clicked
        document.getElementById('borrowButton').addEventListener('click', function() {
            $('#borrowModal').modal('show');
        });
    </script>
@endsection
