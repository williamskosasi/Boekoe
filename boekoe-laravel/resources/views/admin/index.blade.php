@extends('layouts.admin')

@section('content')

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h3 class="mt-5 text-center">Order list</h3>

<table id="order" class="table table-hover mt-5 mb-4">
  <thead>
    <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Total Price</th>
        <th scope="col">Proof of Payment</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $item)
    <tr data-id="{{ $item->id }}">
        <td data-th="Order_id">
            {{ $item->id }}
        </td>
        <td data-th="Total_price">
            Rp{{ number_format($item->total_price,'2',',','.') }}
        </td>
        @if($item->tf_evidence==null)
        <td>Waiting for payment</td>
        @else
        <form action="/viewImage" method="post">
            @csrf
            <td data-th="Proof_of_payment">
                <input type="hidden" value="{{ $item->tf_evidence }}" name="image">
                <button class="btn btn-outline-dark">View</button>
            </td>
        </form>
        @endif
        
        <td data-th="Status">
            {{ $item->status }}
        </td>

        <form action="/viewDetailAdmin" method="post">
            @csrf
            <td class="actions text-center" data-th="">
                <input name="checkoutCounter" type="hidden" value="{{ $item->checkoutCounter }}">
                <input name="user_id" type="hidden" value="{{ $item->user_id }}">
                <input name="order_id" type="hidden" value="{{ $item->id }}">
                <button class="btn btn-outline-info" type="submit">
                    Details
                </button>
            </td>
        </form>

        @if($item->is_done==false)
        <form action="/updateStatus" method="post">
            @csrf
            <td class="actions text-center" data-th="">
                <input name="order_id" type="hidden" value="{{ $item->id }}">
                <button class="btn btn-outline-success text-nowrap" type="submit">
                    Update Status
                </button>
            </td>
        </form>
        @else
        <td data-th="" class="text-center">
            Done
        </td>
        @endif

    </tr>
    @endforeach
  </tbody>
  <tfoot>
        <tr>
        </tr>
  </tfoot>
</table>

@endsection