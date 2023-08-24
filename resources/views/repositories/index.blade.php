@extends('layouts.app')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Researches</h1>
  <div style="display: flex; justify-content:space-between; align-items:center">
    <p class="mb-4">Manage researches in the system.</p>

    <!-- Add New Book Button -->
    <a href="{{ route('repositories.create') }}" class="btn btn-primary mb-4">Add New Research</a>
</div>

<form action="{{ route('repositories.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by title, author, or user name...">

        <select name="accepted" class="form-control">
            <option value="" selected>Filter by Accepted</option>
            <option value="1">Accepted</option>
            <option value="0">Not Accepted</option>
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</form>



  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Researches</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            {{--   table-bordered --}}
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>File link</th>
                        <th>Accepted</th>
                        <th>User</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  {{-- <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>File link</th>
                        <th>Accepted</th>
                        <th>Added by</th>
                        <th>Action</th>
                      </tr>
                  </tfoot> --}}
                  <tbody>
                    @php
                    $rowNumber = ($repositories->currentPage() - 1) * $repositories->perPage() + 1;
                @endphp

                    @foreach($repositories as $repository)
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>{{ $repository->title }}</td>
                        <td>{{ $repository->author }}</td>
                            <td>{{ $repository->file_path }}</td>
                            {{-- <td>{{ $repository->accepted }}</td> --}}
                            <td>{{ $repository->accepted ? 'Yes' : 'No' }}</td>

                            <td>{{ $repository->user->name ?? '' }}</td>

                            <td>
                                <a href="{{ route('repositories.edit', $repository) }}" class="btn btn-primary mb-1" style="width: 75px;">Edit</a>
                                <form action="{{ route('repositories.destroy', $repository) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this research?')" style="width: 75px;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

              </table>
              <div class="mb-4">
                @if ($repositories->total() > 0)
                    <p>{{ $repositories->total() }} results found.</p>
                @else
                    <p>No results found.</p>
                @endif
            </div>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    @if ($repositories->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $repositories->previousPageUrl() }}" tabindex="-1">Previous</a>
                        </li>
                    @endif

                    @foreach ($repositories->getUrlRange(1, $repositories->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $repositories->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($repositories->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $repositories->nextPageUrl() }}">Next</a>
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
