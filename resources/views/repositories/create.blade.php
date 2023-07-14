@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Research</h1>

        <form action="{{ route('repositories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" name="author" id="author" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="file_path">File Path:</label>
                <input type="text" name="file_path" id="file_path" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="accepted">Accepted:</label>
                <div>
                    <input type="radio" name="accepted" id="accepted_yes" value="1" checked>
                    <label for="accepted_yes">Yes</label>
                </div>
                <div>
                    <input type="radio" name="accepted" id="accepted_no" value="0">
                    <label for="accepted_no">No</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
