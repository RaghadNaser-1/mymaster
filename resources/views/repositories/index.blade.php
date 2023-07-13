@extends('layouts.app')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Researches</h1>
  <div style="display: flex; justify-content:space-between; align-items:center">
    <p class="mb-4">Manage researches in the system.</p>

    <!-- Add New Book Button -->
    <a href="{{ route('repositories.create') }}" class="btn btn-primary mb-4">Add New Research</a>
</div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Reviews</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            {{--   table-bordered --}}
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>File link</th>
                        <th>Accepted</th>
                        <th>Added by</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>File link</th>
                        <th>Accepted</th>
                        <th>Added by</th>
                        <th>Action</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach($repositories as $repository)
                    <tr>
                        <td>{{ $repository->title }}</td>
                        <td>{{ $repository->author }}</td>
                            <td>{{ $repository->file_path }}</td>
                            {{-- <td>{{ $repository->accepted }}</td> --}}
                            <td>{{ $repository->accepted ? 'Yes' : 'No' }}</td>

                            <td>{{ $repository->user->name ?? '' }}</td>

                            <td>
                                <a href="{{ route('repositories.edit', $repository) }}" class="btn btn-primary" style="width: 75px;">Edit</a>
                                <form action="{{ route('repositories.destroy', $repository) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this research?')" style="width: 75px;">Delete</button>
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
