@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
        <h1 class="h3 mb-2 text-gray-800">Authors</h1>
        <div style="display: flex; justify-content:space-between; align-items:center">
            <p class="mb-4">Manage authors in the system.</p>

            <!-- Add New Book Button -->
            <a href="{{ route('authors.create') }}" class="btn btn-primary mb-4">Add New Author</a>
        </div>

        <form action="{{ route('authors.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by author name...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Authors</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Bio</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Bio</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @php
                $rowNumber = ($authors->currentPage() - 1) * $authors->perPage() + 1;
            @endphp

                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->bio }}</td>
                        <td>
                            <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-primary" style="width: 75px;">Edit</a>
                            <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this author?')" style="width: 75px;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-4">
            @if ($authors->total() > 0)
                <p>{{ $authors->total() }} results found.</p>
            @else
                <p>No results found.</p>
            @endif
        </div>
        
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                @if ($authors->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $authors->previousPageUrl() }}" tabindex="-1">Previous</a>
                    </li>
                @endif

                @foreach ($authors->getUrlRange(1, $authors->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $authors->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($authors->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $authors->nextPageUrl() }}">Next</a>
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
