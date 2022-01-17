@extends('layouts.main')

@section('content')

    <link rel="stylesheet" href="css/registrationIndex.css">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <main class="form-registration">
                <h1 class="h3 mb-3 fw-normal text-center mt-5">Registration</h1>
                <form action="/register" method="post">
                    @csrf
                    <div class="form-floating">
                    <input type="text" name="username" class="form-control rounded-top @error('username') is-invalid @enderror" id="username" placeholder="username" required value="{{ old('username') }}">
                    <label for="floatingInput">Username</label>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="password" required>
                    <label for="floatingPassword">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="password" name="password_confirmation" class="form-control rounded-bottom @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="password_confirmation">
                    <label for="floatingPassword">Confirm Password</label>
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $password_confirmation }}
                    </div>
                    @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
                </form>
                <small class="d-block text-center mt-3 mb-5"><a href="/login">Login</a></small>
            </main>
        </div>
    </div>

@endsection