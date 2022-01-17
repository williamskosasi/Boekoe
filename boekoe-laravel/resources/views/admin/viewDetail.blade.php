@extends('layouts.admin')

@section('content')

<h3 class="mt-5 text-center">Details for Order ID {{ $order->id }}</h3>

<div class="m-5 text-center">
    <p><b>Name:</b> {{ $order->name }}</p>
    <p><b>Address:</b> {{ $order->street_address }}</p>
    <p><b>City:</b> {{ $order->city }}</p>
    <p><b>Province:</b> {{ $order->province }}</p>
    <p><b>Postal Code:</b> {{ $order->postal_code }}</p>
    <p><b>Phone Number:</b> {{ $order->phone_number }}</p>
</div>

<table id="cart" class="table table-hover mt-5 mb-4">
  <thead>
    <tr>
        <th scope="col">Book</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Subtotal</th>
    </tr>
  </thead>
  <tbody>
    @php
        $total = 0
    @endphp
    @foreach ($data as $item)
    <tr data-id="{{ $item->id }}">
        <td data-th="Book">
            <img src="storage/{{ $item->imageURL }}" class="card-img-top" alt="" style="max-width: 40%; height: auto">
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
        <td data-th="Subtotal">
            Rp{{ number_format($item->price*$item->product_quantity,'2',',','.') }}
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

<div class="text-end">
    <div>
        <h6>Total Price:</h6>
        <h4>Rp{{ number_format($total,'2',',','.') }}</h4>
    </div>
</div>

@endsection