@extends('layouts.main')

@section('content')

@if(!$data->isEmpty())
<h3 class="mt-5 text-center">Please Complete Your Information</h3>

<div class="d-flex flex-row">

    <div>
        <div class="table-responsive h-75 mt-5 mb-4">
            <table id="cart" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Book</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0
                    @endphp
                    @foreach ($data as $item)
                    <tr data-id="{{ $item->id }}">
                        <td data-th="Book">
                            <img src="storage/{{ $item->imageURL }}" class="card-img-top" alt="" style="max-width: 30%; height: auto">
                        </td>
                        <td data-th="Title">
                            {{ $item->title }}
                        </td>
                        <td data-th="Price">
                            Rp{{ number_format($item->price,'2',',','.') }}
                        </td>
                        <td data-th="Quantity">
                            {{ $item->product_quantity }}
                        </td>
                    </tr>
                    @php
                    $total = $total + $item->price*$item->product_quantity
                    @endphp
                    @endforeach
                </tbody>
                <tfoot>
                        <tr>
                        </tr>
                </tfoot>
            </table>
        </div>
        <div class="d-flex float-end mt-3">
            <h6 class="m-3 mt-1 mb-0">
                Total Price:
            </h6> 
            <h4 class="m-3 mt-0 mb-0">Rp{{ number_format($total,'2',',','.') }}</h4>
        </div>
    </div>

    <form action="/doOrder" method="post" class="m-5 col-md-5">
        @csrf
        <div class="form-floating mt-3 mb-3">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="name" required value="{{ old('name') }}">
        <label for="name">Full Name</label>
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
        <input type="text" name="streetAddress" class="form-control @error('streetAddress') is-invalid @enderror" id="streetAddress" placeholder="streetAddress" required value="{{ old('streetAddress') }}">
        <label for="streetAddress">Street Address</label>
        @error('streetAddress')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="city" placeholder="city" required value="{{ old('city') }}">
        <label for="city">City</label>
        @error('city')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
        <input type="text" name="province" class="form-control @error('province') is-invalid @enderror" id="province" placeholder="province" required value="{{ old('province') }}">
        <label for="province">Province</label>
        @error('province')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
        <input type="text" name="postalcode" class="form-control @error('postalcode') is-invalid @enderror" id="postalcode" placeholder="postalcode" pattern="[0-9]{5}" required value="{{ old('postalcode') }}">
        <label for="postalcode">Postal Code</label>
        @error('postalcode')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-floating mt-3 mb-3">
        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="phone" pattern="[0-9]+|.+[0-9]+" required value="{{ old('phone') }}">
        <label for="phone">Phone Number</label>
        @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <button class="btn btn-outline-success float-end btn-lg mt-5" type="submit">Order</button>
    </form>

</div>
@endif

@endsection