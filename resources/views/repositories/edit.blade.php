@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="row">
            <div class="col-md-8 offset-md-2"> --}}
                <h2>Edit Researh</h2>
                <form action="{{ route('repositories.update', $repository->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $repository->title }}">
                    </div>

                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" id="author" name="author" value="{{ $repository->author }}">
                    </div>

                    <div class="form-group">
                        <label for="file_path">File Path</label>
                        <input type="text" class="form-control" id="file_path" name="file_path" value="{{ $repository->file_path }}">
                    </div>

                    <div class="form-group">
                        <label for="accepted">Accepted:</label>
                        <div>
                            <input type="radio" name="accepted" id="accepted_yes" value="1" {{ $repository->accepted ? 'checked' : '' }}>
                            <label for="accepted_yes">Yes</label>
                        </div>
                        <div>
                            <input type="radio" name="accepted" id="accepted_no" value="0" {{ !$repository->accepted ? 'checked' : '' }}>
                            <label for="accepted_no">No</label>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            {{-- </div>
        </div> --}}
    </div>
@endsection
