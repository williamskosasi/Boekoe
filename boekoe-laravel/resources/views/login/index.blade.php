@extends('layouts.main')

@section('content')

    <link rel="stylesheet" href="css/loginIndex.css">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if(session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <main class="form-signin">
                <h1 class="h3 mb-3 fw-normal text-center mt-5">Login</h1>
                <form action="/login" method="post">
                    @csrf
                    <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    </div>
                    <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="password" required>
                    <label for="password">Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                </form>
                <small class="d-block text-center mt-3 mb-5"><a href="/register">Register</a></small>
            </main>
        </div>
    </div>

@endsection