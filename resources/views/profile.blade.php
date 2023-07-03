<!-- resources/views/profile.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 text-center mt-4 mb-4">
                <h1 class="mt-0">User Profile</h1>
                <hr class="divider" />

                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">Email: {{ $user->email }}</p>
                                <!-- Add more user profile information as needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
