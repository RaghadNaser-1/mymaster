@extends('layouts.app')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Categories</h1>
  <div style="display: flex; justify-content:space-between; align-items:center">
    <p class="mb-4">Manage categories in the system.</p>

    <!-- Add New Book Button -->
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-4">Add New category</a>
</div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            {{--   table-bordered --}}
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Action</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary" style="width: 75px;">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')" style="width: 75px;">Delete</button>
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
