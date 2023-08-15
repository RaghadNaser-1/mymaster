@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
        <h1 class="h3 mb-2 text-gray-800">Borrow Records</h1>
        <div style="display: flex; justify-content:space-between; align-items:center">
            <p class="mb-4">Manage borrow records in the system.</p>

            <!-- Add New Book Button -->
            <a href="{{ route('borrows.create') }}" class="btn btn-primary mb-4">Add New Borrow</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Borrow Records</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book</th>
                    <th>User</th>
                    <th>Borrowed At</th>
                    <th>Due Date</th>
                    <th>Returned</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrows as $borrow)
                <tr>
                    <td>{{ $borrow->id }}</td>
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
                            <a href="{{ route('borrows.edit', $borrow) }}" class="btn btn-primary" style="width: 75px;">Edit</a>
                            <form action="{{ route('borrows.destroy', $borrow) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this borrow record?')" style="width: 75px;">Delete</button>
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
