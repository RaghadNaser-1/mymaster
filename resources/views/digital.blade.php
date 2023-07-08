@extends('layouts.master')

@section('content')
    <div class="row g-0" style="background-color: #f4623a; height: 70px;"></div>

    <div class="container-fluid px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-10 text-center mt-4">
                <h1 class="mt-0">Digital Repository</h1>
                <hr class="divider" />

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <p>Welcome to our university's digital repository. Here, you can explore a wide range of research papers, theses, dissertations, and other scholarly works produced by our students and faculty members.</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-8 offset-md-2">
                        <h2>Search the Repository</h2>
                        <p>Use the search feature to find specific items in the digital repository:</p>
                        <form class="form-inline" action="{{ route('repository') }}" method="GET">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="Search the repository" aria-label="Search" name="search">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-8 offset-md-2">
                        <button class="btn btn-primary" id="addResearchButton">Add New Research</button>
                    </div>
                </div>

                @if ($searchResults->count() > 0)
                    <div class="row mt-4">
                        <div class="col-md-10 offset-md-1">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($searchResults as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->author }}</td>
                                            <td>
                                                <a href="{{ $item->file_path }}" target="_blank" class="btn btn-primary">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="row mt-4">
                        <div class="col-md-8 offset-md-2">
                            <p>No results found.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addResearchModal" tabindex="-1" role="dialog" aria-labelledby="addResearchModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addResearchModalLabel">Add New Research</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    @auth
                    <form id="addResearchForm" action="{{ route('repository.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="researchTitle">Title</label>
                            <input type="text" class="form-control" id="researchTitle" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="researchAuthor">Author</label>
                            <input type="text" class="form-control" id="researchAuthor" name="author" required>
                        </div>
                        <div class="form-group">
                            <label for="researchFilePath">File Link</label>
                            <input type="text" class="form-control" id="researchFilePath" name="file_path" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>

                    @else
                        <p>Please log in to add new research.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('addResearchButton').addEventListener('click', function() {

                $('#addResearchModal').modal('show');

        });
    </script>
@endsection


