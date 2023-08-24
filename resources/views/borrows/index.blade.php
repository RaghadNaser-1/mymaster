@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
        <h1 class="h3 mb-2 text-gray-800">Borrow Records</h1>
        <div style="display: flex; justify-content:space-between; align-items:center">
            <p class="mb-4">Manage borrow records in the system.</p>

            <!-- Add New Book Button -->
            <a href="{{ route('borrows.create') }}" class="btn btn-primary mb-4">Add New Borrow</a>
        </div>

        <form action="{{ route('borrows.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by book title or user name...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Borrow Records</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Book</th>
                    <th>User</th>
                    <th>Borrowed At</th>
                    <th>Due Date</th>
                    <th>Returned</th>
                    <th>Actions</th>
                </tr>
            </thead>
            {{-- <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Book</th>
                    <th>User</th>
                    <th>Borrowed At</th>
                    <th>Due Date</th>
                    <th>Returned</th>
                    <th>Actions</th>
                </tr>
            </tfoot> --}}
            <tbody>
                @php
                $rowNumber = ($borrows->currentPage() - 1) * $borrows->perPage() + 1;
            @endphp

                @foreach ($borrows as $borrow)
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>{{ $borrow->book->title }}</td>
                    <td>{{ $borrow->user->name }}</td>
                    <td>{{ $borrow->borrowed_at }}</td>
                    <td>{{ $borrow->estimated_end_time }}</td>
                    <td>
                        @if ($borrow->returned)
                            Yes
                        @else
                            <a href="{{ route('borrows.return', $borrow) }}" class="btn btn-primary">Return Book</a>
                        @endif
                    </td>


                        <td>
                            <a href="{{ route('borrows.edit', $borrow) }}" class="btn btn-primary mb-1" style="width: 75px;">Edit</a>
                            <form action="{{ route('borrows.destroy', $borrow) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('Are you sure you want to delete this borrow record?')" style="width: 75px;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mb-4">
            @if ($borrows->total() > 0)
                <p>{{ $borrows->total() }} results found.</p>
            @else
                <p>No results found.</p>
            @endif
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                @if ($borrows->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $borrows->previousPageUrl() }}" tabindex="-1">Previous</a>
                    </li>
                @endif

                @foreach ($borrows->getUrlRange(1, $borrows->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $borrows->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($borrows->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $borrows->nextPageUrl() }}">Next</a>
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
