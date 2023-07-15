@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Borrow</h1>

        <form action="{{ route('borrows.update', $borrow) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- <div class="form-group">
                <label for="book_id">Book:</label>
                <select name="book_id" id="book_id" class="form-control" readonly>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" {{ $book->id == $borrow->book_id ? 'selected' : '' }}>{{ $book->title }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="book_title">Book:</label>
                <input type="text" id="book_title" class="form-control" value="{{ $borrow->book->title }}" readonly>
            </div>


            <div class="form-group">
                <label for="borrowed_at">Borrowed At:</label>
                <input type="text" name="borrowed_at" id="borrowed_at" class="form-control" value="{{ $borrow->borrowed_at }}" readonly>
            </div>


            <div class="form-group">
                <label for="returned">Returned:</label>
                <select name="returned" id="returned" class="form-control">
                    <option value="0" {{ $borrow->returned == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $borrow->returned == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
