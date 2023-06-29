@extends('layouts.app')

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
      For more information about DataTables, please visit the <a target="_blank"
          href="https://datatables.net">official DataTables documentation</a>.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            {{--   table-bordered --}}
              <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Action</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td> Edit Delete</td>
                        </tr>
                    @endforeach
                </tbody>

              </table>
          </div>
      </div>
  </div>

@endsection
