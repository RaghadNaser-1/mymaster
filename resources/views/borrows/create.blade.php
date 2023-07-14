@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Borrow Record</h1>

        <form action="{{ route('borrows.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="book_id">Book:</label>
                <select name="book_id" id="book_id" class="form-control">
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">User:</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="borrowed_at">Borrowed At:</label>
                <input type="date" id="borrowed_at" name="borrowed_at" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="return_date">Return Date:</label>
                <input type="date" id="return_date" name="estimated_end_time" class="form-control" readonly>
            </div>


            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    <script>
        document.getElementById('borrowed_at').addEventListener('change', function() {
            const borrowedAt = new Date(this.value);
            const returnDate = new Date(borrowedAt.getTime() + 14 * 24 * 60 * 60 * 1000); // Add 14 days (2 weeks)

            // Format the return date as "YYYY-MM-DD"
            const formattedReturnDate = returnDate.toISOString().split('T')[0];
            document.getElementById('return_date').value = formattedReturnDate;
        });
    </script>

@endsection
