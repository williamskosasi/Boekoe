@extends('layouts.main')

@section('content')

@if(session()->has('successUpdate'))
    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
        {{ session('successUpdate') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('successDelete'))
    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
        {{ session('successDelete') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h3 class="mt-5 text-center">Here is your cart</h3>

<table id="cart" class="table table-hover mt-5 mb-4">
  <thead>
    <tr>
        <th scope="col" style="width:20%">Book</th>
        <th scope="col" style="width:45%">Title</th>
        <th scope="col" style="width:10%">Price</th>
        <th scope="col" style="width:5%">Quantity</th>
        <th scope="col" style="width:10%">Subtotal</th>
        <th scope="col" style="width:5%"></th>
        <th scope="col" style="width:5%"></th>
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
        <form action="/cartUpdate" method="post">
        @csrf
            <td data-th="Quantity">
                <input name="quantity" type="number" min="0" value="{{ $item->product_quantity }}"/>
            </td>
            <td data-th="Subtotal">
                Rp{{ number_format($item->price*$item->product_quantity,'2',',','.') }}
            </td>
            <td data-th="">
                    <input name="id" type="hidden" value="{{ $item->id }}">
                    <button class="btn btn-outline-warning" type="submit">
                        Update
                    </button>
                </td>
        </form>
        <form action="/cartDelete" method="post">
            @csrf
            <td class="actions" data-th="">
                <input name="id" type="hidden" value="{{ $item->id }}">
                <button class="btn btn-outline-danger" type="submit">
                    Delete
                </button>
            </td>
        </form>
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

<div class="d-flex justify-content-between align-items-center">
    <div>
        <p>
            Total Price: <h4>Rp{{ number_format($total,'2',',','.') }}</h4>
        </p> 
    </div>
    @if(!$data->isEmpty())
    <button class="btn btn-outline-success" type="button" onclick="location.href='/cartCheckout'">Checkout</button>
    @endif
</div>

@endsection