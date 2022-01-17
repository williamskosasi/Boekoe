@extends('layouts.admin')

@section('content')

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h3 class="m-5 text-center">Add a New Book</h3>

<div class="d-flex justify-content-center mb-5">
    <form action="/addBooks" method="post" class="col-md-5" enctype="multipart/form-data">
        @csrf
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="slug" required value="{{ old('slug') }}">
            <label for="slug">Slug</label>
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="title" required value="{{ old('title') }}">
            <label for="title">Title</label>
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" id="author" placeholder="author" required value="{{ old('author') }}">
            <label for="author">Author</label>
            @error('author')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="price" pattern="[0-9]+" required value="{{ old('price') }}">
            <label for="slug">price</label>
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="d-flex mt-3 mb-3">
            <label for="image" class="m-1">Image</label>
            <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" type="file">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" id="category" placeholder="category" required value="{{ old('category') }}">
            <label for="category">Category</label>
            @error('category')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="length" class="form-control @error('length') is-invalid @enderror" id="length" placeholder="length" pattern="[0-9]+" required value="{{ old('length') }}">
            <label for="length">Length</label>
            @error('length')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="language" class="form-control @error('language') is-invalid @enderror" id="language" placeholder="language" required value="{{ old('language') }}">
            <label for="language">Language</label>
            @error('language')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror" id="publisher" placeholder="publisher" required value="{{ old('publisher') }}">
            <label for="publisher">Publisher</label>
            @error('publisher')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="dimensions" class="form-control @error('dimensions') is-invalid @enderror" id="dimensions" placeholder="dimensions" required value="{{ old('dimensions') }}">
            <label for="dimensions">Dimensions</label>
            @error('dimensions')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="isbn10" class="form-control @error('isbn10') is-invalid @enderror" id="isbn10" placeholder="isbn10" pattern="[0-9]{10}" required value="{{ old('isbn10') }}">
            <label for="isbn10">ISBN 10</label>
            @error('isbn10')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="text" name="isbn13" class="form-control @error('isbn13') is-invalid @enderror" id="isbn13" placeholder="isbn13" pattern="[0-9]{3}-[0-9]{10}" required value="{{ old('isbn13') }}">
            <label for="isbn13">ISBN 13</label>
            @error('isbn13')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="text-center">
            <button class="btn btn-outline-success btn-lg mt-5" type="submit">Add Book</button>
        </div>
    </form>
</div>

@endsection