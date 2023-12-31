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

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" ><a href="{{ route('books.index') }}">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>

            </ol>
        </nav>

        <div class=" mb-4">
            <div class="row g-4">
                <div class="col-md-3">
                    <img src="{{ $book->image }}" class="card-img img-fluid" alt="{{ $book->title }}">
                </div>

                {{-- <div class="col-md-1"></div> --}}
                <div class="card col-md-9">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        {{-- <p class="card-text">Author: {{ $book->author }}</p> --}}
                        <p class="card-text">Authors:
                            @foreach ($book->authors as $index => $author)
                                <a href="{{ route('author.show', $author->id) }}">{{ $author->name }}</a>
                                @if ($index < count($book->authors) - 1)
                                    ,
                                @endif
                            @endforeach
                        </p>


                        <p class="card-text">Category: {{ $book->category->name }}</p>
                        <p class="card-text">{{ $book->description }}</p>
                        <button class="btn btn-primary " id="borrowButton">Borrow</button>
                        @auth
    {{-- <form action="{{ route('books.favorite', $book) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Add to Favorites</button>
    </form> --}}
    {{-- <a href="{{ route('books.favorite', $book) }}" class="btn btn-primary">Add to Favorites</a> --}}
    <a href="{{ route('books.favorite', $book) }}" class="btn btn-primary"><i class="fas fa-heart"></i> Add to Favorites</a>

@endauth

                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="book-details card-body">
            <!-- Book information... -->

           <!-- Reviews -->
        {{-- <h3>Reviews</h3> --}}
        <h2 class="mb-4 highlighted">Reviews</h2>

        @forelse ($book->reviews as $review)
            <div class="review">
                <h5>{{ $review->user->name }}</h5>
                <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $review->rating)
                        <i class="fas fa-star filled"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <p>{{ $review->comment }}</p>
            </div>
        @empty
            <p>No reviews yet.</p>
        @endforelse


            <!-- Add a review -->
            @auth
                <h3>Add a Review</h3>
                <form action="{{ route('reviews.store', $book) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="5">5 stars</option>
                            <option value="4">4 stars</option>
                            <option value="3">3 stars</option>
                            <option value="2">2 stars</option>
                            <option value="1">1 star</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            @else
                <p>You must <a href="{{ route('login') }}">login</a> to leave a review.</p>
            @endauth
        </div>
    </div>

    <div class="container">
        <div class="related-books mt-5">
            <h2 class="mb-4 highlighted">Related Books</h2>
            <div class="row">
                @foreach ($relatedBooks as $relatedBook)
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('books.show', $relatedBook->id) }}">
                        <div class="card h-100">

                            <img src="{{ $relatedBook->image }}" class="card-img" alt="{{ $relatedBook->title }}" height="100%">
                            {{-- <div class="card-body text-center">
                                <a href="{{ route('books.show', $relatedBook->id) }}" class="btn btn-primary">View Details</a>
                            </div> --}}
                        </div>
                        </a>

                    </div>
                @endforeach
            </div>
        </div>
</div>

<style>
    h2.highlighted {
        background-color: #f4623a; /* Background color for highlighting */
        color: white; /* Text color for highlighted background */
        font-size: 24px; /* Change the font size to your desired size */
        font-weight: bold; /* You can adjust the font weight as needed */
        margin-bottom: 20px; /* Add some spacing at the bottom */
        padding: 10px; /* Add some padding to the highlighted area */
        border-radius: 5px; /* Add rounded corners */
    }
    .rating {
    color: #f4623a;
}

.rating .filled {
    color: #f4623a;
}

.card-img{
    border-radius: 5px;
    border: 1px solid #6c757d;
}

    .review {
        margin-bottom: 20px;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
    }

    .review h5 {
        margin-bottom: 5px;
    }

    .review p {
        margin-bottom: 10px;
    }
</style>
    <!-- Borrow Modal -->
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



    <script>
        // Show the borrow modal when the borrow button is clicked
        document.getElementById('borrowButton').addEventListener('click', function() {
            $('#borrowModal').modal('show');
        });
    </script>
@endsection
