@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
        <h1 class="h3 mb-2 text-gray-800">Authors</h1>
        <div style="display: flex; justify-content:space-between; align-items:center">
            <p class="mb-4">Manage authors in the system.</p>

            <!-- Add New Book Button -->
            <a href="{{ route('authors.create') }}" class="btn btn-primary mb-4">Add New Author</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Authors</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Bio</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
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
    </div>
</div>
</div>

@endsection
