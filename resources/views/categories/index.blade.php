@extends('layouts.app')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Categories</h1>
  <div style="display: flex; justify-content:space-between; align-items:center">
    <p class="mb-4">Manage categories in the system.</p>

    <!-- Add New Book Button -->
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-4">Add New category</a>
</div>
<form action="{{ route('categories.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by category name...">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</form>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            {{--   table-bordered --}}
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  {{-- <tfoot>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Action</th>
                      </tr>
                  </tfoot> --}}
                  <tbody>
                    @php
        $rowNumber = ($categories->currentPage() - 1) * $categories->perPage() + 1;
    @endphp
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $rowNumber++ }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary mb-1" style="width: 75px;">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this category?')" style="width: 75px;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

              </table>
              <div class="mb-4">
                @if ($categories->total() > 0)
                    <p>{{ $categories->total() }} results found.</p>
                @else
                    <p>No results found.</p>
                @endif
            </div>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    @if ($categories->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $categories->previousPageUrl() }}" tabindex="-1">Previous</a>
                        </li>
                    @endif

                    @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $categories->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($categories->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $categories->nextPageUrl() }}">Next</a>
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
