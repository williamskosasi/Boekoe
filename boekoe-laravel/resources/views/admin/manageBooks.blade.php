@extends('layouts.admin')

@section('content')

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('successPrice'))
    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
        {{ session('successPrice') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h3 class="m-5 text-center">Book list</h3>

<div class="col">
    @foreach ($products as $product)
    @if($product->available==true)
    <div class="col mt-3">
        <div class="card d-flex flex-row">
            <img src="storage/{{ $product->imageURL }}" class="card-img-top" alt="" style="max-width: 15%; height: auto">
            <div class="card-body">
                <h4 class="card-title">{{ $product->title }}</h4>
                <p class="card-text">by {{ $product->author }}</p>
                <form action="/editPrice" method="post">
                    @csrf
                    <div>
                        <input class="card-text" type="text" value="{{ $product->price }}" name="price"></input>
                        <button class="btn btn-warning m-2" type="submit">Edit Price</button>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" value="{{ $product->price }}" name="last_price"></input>
                    </div>
                </form>
                
                <form action="/setAvailable" method="post">
                    @csrf
                    <button class="btn btn-warning" type="submit">Set to Not Available</button>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </form>
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
                <form action="/editPrice" method="post">
                    @csrf
                    <div>
                        <input class="card-text" type="text" value="{{ $product->price }}" name="price" pattern="[0-9]+"></input>
                        <button class="btn btn-warning m-2" type="submit">Edit Price</button>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" value="{{ $product->price }}" name="last_price"></input>
                    </div>
                </form>
                <form action="/setAvailable" method="post">
                    @csrf
                    <button class="btn btn-warning" type="submit">Set to Available</button>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </form>
                <p class="card-text text-danger mt-2">Not Available</p>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>

@endsection