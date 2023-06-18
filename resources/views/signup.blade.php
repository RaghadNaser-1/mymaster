@extends('layouts.master')
@section('content')
<style>
    .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
</style>
@if(session('success'))
{{-- <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        {{ session('success') }}
    </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div> --}}
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif
<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="../assets/img/lib1.png"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form action="{{ route('submit.signup') }}" method="POST">
                @csrf
                <!-- Name input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3">Name</label>
                    <input type="text" id="form3Example3" class="form-control form-control-lg"
                        placeholder="Enter your name" name="name" value="{{ old('name') }}" />
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3">Email</label>
                    <input type="email" id="form3Example3" class="form-control form-control-lg"
                        placeholder="Enter a valid email address" name="email" value="{{ old('email') }}" />
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="form3Example4">Password</label>
                    <input type="password" id="form3Example4" class="form-control form-control-lg"
                        placeholder="Enter password" name="password" />
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-outline mb-3">
                    <label class="form-label" for="form3Example4">Repeat Password</label>
                    <input type="password" id="form3Example4" class="form-control form-control-lg"
                        placeholder="Repeat password" name="repeat" />
                    @error('repeat')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Sign up</button>
                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login"
                            class="link-danger">Login</a></p>
                </div>

            </form>
        </div>
      </div>
    </div>

  </section>
@endsection
