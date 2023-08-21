<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$userCount}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Books</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$bookCount}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Authors</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$authorCount}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Borrows</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$borrowCount}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Most Borrowed Book Card Example -->
<div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">

                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Most Borrowed Book</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        @if ($mostBorrowedBook)

                            <p> {{ $mostBorrowedBook->title }}</p>
                            {{-- <img src="{{ $mostBorrowedBook->image }}" alt="book cover" width="150px" height="200px"> --}}
                            <p>Total Borrow: {{ $mostBorrowedBook->borrows_count}}</p>
                        @else
                            No books found.
                        @endif
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-book-open fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">

                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        The user who borrowed the most books is:</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        @if ($mostBorrowedUser)
                        <p> {{ $mostBorrowedUser->name }}</p>
                        <p>Total books borrowed: {{ $mostBorrowedUser->borrows_count }}</p>
                    @else
                        <p>No users with borrowing history found.</p>
                    @endif

                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>



    </div>

<div class="row">
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <canvas id="borrowChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="newUsersChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var borrowsPerMonth = @json($borrowsPerMonth);

        var ctx = document.getElementById('borrowChart').getContext('2d');
        var borrowChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: Object.keys(borrowsPerMonth),
                datasets: [{
                    label: 'Borrows per Month',
                    data: Object.values(borrowsPerMonth),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        var newUsersPerMonth = @json($newUsersPerMonth);

        var ctx = document.getElementById('newUsersChart').getContext('2d');
        var newUsersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(newUsersPerMonth),
                datasets: [{
                    label: 'New Users Per Month',
                    data: Object.values(newUsersPerMonth),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
