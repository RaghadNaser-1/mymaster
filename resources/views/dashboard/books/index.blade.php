@extends('layouts.app')

@section('content')
  <!-- Page Heading -->


  <h1 class="h3 mb-2 text-gray-800">Books</h1>
  <div style="display: flex; justify-content:space-between; align-items:center">
  <p class="mb-4">Manage books in the system.</p>

  <!-- Add New Book Button -->
  <a href="{{ route('dashboard.books.create', 'dashboard') }}" class="btn btn-primary mb-4">Add New Book</a>
</div>

<form action="{{ route('bookstable', 'dashboard') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="input-group">
        {{-- <div class="col-md-4"> --}}
            <input type="text" class="form-control" placeholder="Search by title, author, description" name="search">
        {{-- </div> --}}
        {{-- <div class="col-md-4"> --}}
            <select class="form-control" name="category">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        {{-- </div> --}}
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
        </div>
    </div>
</form>

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
                          <th>#</th>
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
                          <th>#</th>
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
                    @php
                    $rowNumber = ($books->currentPage() - 1) * $books->perPage() + 1;
                @endphp
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $rowNumber++ }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->description }}</td>
                            <td>{{ $book->category->name }}</td>
                            <td><img src="{{ $book->image }}" alt="Book Image" height="75" width="50"></td>
                            <td>{{ $book->featured ? 'Yes' : 'No' }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <a href="{{ route('dashboard.books.edit', $book->id) }}" class="btn btn-primary mb-1" style="width: 75px;">Edit</a>
                                <form action="{{ route('dashboard.books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')" style="width: 75px;">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>

              <div class="mb-4">
                @if ($books->total() > 0)
                    <p>{{ $books->total() }} results found.</p>
                @else
                    <p>No results found.</p>
                @endif
            </div>

              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    @if ($books->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $books->previousPageUrl() }}" tabindex="-1">Previous</a>
                        </li>
                    @endif

                    @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $books->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($books->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $books->nextPageUrl() }}">Next</a>
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
