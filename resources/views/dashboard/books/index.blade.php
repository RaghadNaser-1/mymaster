@extends('layouts.app')

@section('content')
  <!-- Page Heading -->


  <h1 class="h3 mb-2 text-gray-800">Books</h1>
  <div style="display: flex; justify-content:space-between; align-items:center">
  <p class="mb-4">Manage books in the system.</p>

  <!-- Add New Book Button -->
  <a href="{{ route('dashboard.books.create', 'dashboard') }}" class="btn btn-primary mb-4">Add New Book</a>
</div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Books</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            {{--   table-bordered --}}
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <!-- Table Headings -->
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Author</th>
                          <th>Description</th>
                          <th>Category</th>
                          <th>Image</th>
                          <th>Featured</th>
                          <th>Quantity</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <!-- Table Footings -->
                  <tfoot>
                      <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Author</th>
                          <th>Description</th>
                          <th>Category</th>
                          <th>Image</th>
                          <th>Featured</th>
                          <th>Quantity</th>
                          <th>Action</th>
                      </tr>
                  </tfoot>
                  <!-- Table Body -->
                  <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->description }}</td>
                            <td>{{ $book->category->name }}</td>
                            <td><img src="{{ $book->image }}" alt="Book Image" height="50"></td>
                            <td>{{ $book->featured ? 'Yes' : 'No' }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <a href="{{ route('dashboard.books.edit', $book->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('dashboard.books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
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
