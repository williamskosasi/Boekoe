@extends('layouts.admin')

@section('content')

<h3 class="mt-5 text-center">Proof of Payment for Order ID {{ $order->id }}</h3>

<div class="text-center m-5">
    <img src="{{ asset('storage/' . $order->tf_evidence) }}" alt="">
</div>

@endsection