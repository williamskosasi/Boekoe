@extends('layouts.main')

@section('content')

    <div class="row justify-content-center m-5">
        <div class="col-md-10">
            <form action="/">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search books by title, author, or category" name="searchBar">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col">
        @foreach ($products as $product)
        @if($product->available==true)
        <div class="col mt-3">
            <div class="card d-flex flex-row">
                <img src="storage/{{ $product->imageURL }}" class="card-img-top" alt="" style="max-width: 15%; height: auto">
                <div class="card-body">
                    <h4 class="card-title">{{ $product->title }}</h4>
                    <p class="card-text">by {{ $product->author }}</p>
                    <p class="card-text">Rp{{ number_format($product->price,'2',',','.') }}</p>
                    <a href="/{{ $product->slug }}" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
        @else
        <div class="col mt-3">
            <div class="card d-flex flex-row opacity-50">
                <img src="storage/{{ $product->imageURL }}" class="card-img-top" alt="" style="max-width: 15%; height: auto">
                <div class="card-body">
                    <h4 class="card-title">{{ $product->title }}</h4>
                    <p class="card-text">by {{ $product->author }}</p>
                    <p class="card-text">Rp{{ number_format($product->price,'2',',','.') }}</p>
                    <p class="card-text text-danger mt-2">Not Available</p>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

@endsection