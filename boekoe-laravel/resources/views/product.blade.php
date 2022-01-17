@extends('layouts.main')

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mt-5 mb-5 d-flex flex-row">
        <img src="storage/{{ $product->imageURL }}" alt="" style="max-width: 30%; height: auto">
        <div class="row m-3 mt-0 mb-0">
            <h3 class="">{{ $product->title }}</h3>
            <p>
                by {{ $product->author }}
            </p>
            <p>
                <b>Price</b>: Rp{{ number_format($product->price,'2',',','.') }}
            </p>
            <p>
                <b>Category</b>: {{ $product->category }}
            </p>
            <p>
                <b>Hardcover</b>: {{ $product->length }} pages
            </p>
            <p>
                <b>Language</b>: {{ $product->language }}
            </p>
            <p>
                <b>Publisher</b>: {{ $product->publisher }}
            </p>
            <p>
                <b>Dimensions</b>: {{ $product->dimensions }}
            </p>
            <p>
                <b>ISBN-10</b>: {{ $product->isbn10 }}
            </p>
            <p>
                <b>ISBN-13</b>: {{ $product->isbn13 }}
            </p>
            @if($product->available==true)
            <hr class="m-3">
            <form action="/cartInsert" method="post">
                @csrf
                <div class="d-flex flex-row align-items-center">
                    <b>Quantity</b>
                    <input name="quantity" class="m-3" type="number" min="0"/>
                    <input name="product_id" type="hidden" value="{{ $product->id }}">
                </div>
                <button type="submit" class="btn btn-outline-success d-flex flex-row align-items-center mt-3">
                    <i class="fa fa-shopping-cart" style="font-size:120%;"></i>
                    <p class="m-2">Add to cart</p>
                </button>
            </form>
            @else
            <p class="card-text text-danger">Not Available</p>
            @endif
        </div>
        
    </div>

    <script src="./src/bootstrap-input-spinner.js"></script>
    <script>
        $("input[type='number']").inputSpinner()
    </script>

@endsection