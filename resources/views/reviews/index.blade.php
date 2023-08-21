@extends('layouts.app')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Reviews</h1>
  <div style="display: flex; justify-content:space-between; align-items:center">
    <p class="mb-4">Manage reviews in the system.</p>

    <!-- Add New Book Button -->
    {{-- <a href="{{ route('reviews.create') }}" class="btn btn-primary mb-4">Add New Review</a> --}}
</div>
<form action="{{ route('reviews.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by user name or book title...">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</form>
<div class="mb-4">
    @if ($reviews->total() > 0)
        <p>{{ $reviews->total() }} results found.</p>
    @else
        <p>No results found.</p>
    @endif
</div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Reviews</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            {{--   table-bordered --}}
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>User</th>
                          <th>Book</th>
                          <th>Comment</th>
                          <th>Rating</th>

                          <th>Action</th>
                      </tr>
                  </thead>
                  {{-- <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Book</th>
                        <th>Comment</th>
                        <th>Rating</th>

                        <th>Action</th>
                      </tr>
                  </tfoot> --}}
                  <tbody>
                    @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->user->name }}</td>
                            <td>{{ $review->book->title }}</td>
                            <td>{{ $review->comment }}</td>
                            <td>{{ $review->rating }}</td>

                            <td>
                                {{-- <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-primary" style="width: 75px;">Edit</a> --}}
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this review?')" style="width: 75px;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

              </table>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    @if ($reviews->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $reviews->previousPageUrl() }}" tabindex="-1">Previous</a>
                        </li>
                    @endif

                    @foreach ($reviews->getUrlRange(1, $reviews->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $reviews->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($reviews->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $reviews->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    @endif
                </ul>
            </nav>
          </div>
      </div>
  </div>

@endsection
