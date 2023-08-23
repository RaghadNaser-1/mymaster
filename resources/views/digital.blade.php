@extends('layouts.master')

@section('content')
    <div class="row g-0" style="background-color: #f4623a; height: 70px;"></div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center mb-4">
                <h1 class="display-4">Digital Repository</h1>
                <hr class="divider" />
                <p class="lead">Explore a wide range of research papers, theses, dissertations, and scholarly works.</p>
            </div>

            <div class="row mb-4">
                <div class="col-md-8 offset-md-2">
                    <form class="input-group" action="{{ route('repository') }}" method="GET">
                        <input type="search" class="form-control" placeholder="Search the repository" aria-label="Search" name="search">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                </div>
            </div>

            @if ($searchResults->total() > 0)


            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rowNumber = ($searchResults->currentPage() - 1) * $searchResults->perPage() + 1;
                        @endphp
                        @foreach ($searchResults as $item)
                        <tr>
                            <td>{{ $rowNumber++ }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->author }}</td>
                            <td>
                                <a href="{{ $item->file_path }}" target="_blank" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mb-4">
                    <div class="">
                        <p>{{ $searchResults->total() }} results found.</p>
                    </div>
                    <div class="">
                        <button class="btn btn-primary" id="addResearchButton">Add New Research</button>
                    </div>
                {{-- </div> --}}
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        @if ($searchResults->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $searchResults->previousPageUrl() }}" tabindex="-1">Previous</a>
                            </li>
                        @endif

                        @foreach ($searchResults->getUrlRange(1, $searchResults->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $searchResults->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($searchResults->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $searchResults->nextPageUrl() }}">Next</a>
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

            {{-- <div class="d-flex justify-content-end mt-4">
                {{ $searchResults->links() }}
            </div> --}}

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


