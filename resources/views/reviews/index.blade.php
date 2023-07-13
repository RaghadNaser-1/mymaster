@extends('layouts.app')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Reviews</h1>
  <div style="display: flex; justify-content:space-between; align-items:center">
    <p class="mb-4">Manage reviews in the system.</p>

    <!-- Add New Book Button -->
    {{-- <a href="{{ route('reviews.create') }}" class="btn btn-primary mb-4">Add New Review</a> --}}
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
                          <th>User</th>
                          <th>Book</th>
                          <th>Comment</th>
                          <th>Rating</th>

                          <th>Action</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>User</th>
                        <th>Book</th>
                        <th>Comment</th>
                        <th>Rating</th>

                        <th>Action</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($reviews as $review)
                        <tr>
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
          </div>
      </div>
  </div>

@endsection
