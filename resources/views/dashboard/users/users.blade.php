@extends('layouts.app')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Users</h1>
  <div style="display: flex; justify-content:space-between; align-items:center">
    <p class="mb-4">Manage users in the system.</p>

    <!-- Add New Book Button -->
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-4">Add New User</a>
</div>

<!-- Search Input Field -->
<form action="{{ route('userstable') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search users" name="search">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</form>
<div class="mb-4">
    @if ($users->total() > 0)
        <p>{{ $users->total() }} results found.</p>
    @else
        <p>No results found.</p>
    @endif
</div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Users</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            {{--   table-bordered --}}
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  {{-- <tfoot>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Action</th>
                      </tr>
                  </tfoot> --}}
                  <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary" style="width: 75px;">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')" style="width: 75px;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

              </table>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1">Previous</a>
                        </li>
                    @endif

                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
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
