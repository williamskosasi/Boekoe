@extends('layouts.main')

@section('content')

@if(session()->has('successUpload'))
    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
        {{ session('successUpload') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h3 class="mt-5 text-center">Here is your order list</h3>
<table id="order" class="table table-hover mt-5 mb-4">
  <thead>
    <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Total Price</th>
        <th scope="col">Proof of Payment</th>
        <th scope="col">Status</th>
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

        <form action="/uploadImage" method="post" enctype="multipart/form-data">
            @csrf
            <td data-th="Proof_of_payment">
                @if($item->tf_evidence==null)
                <div class="d-flex mb-3">
                    <input class="form-control form-control-md" id="image" name="image" type="file">
                    <button class="btn btn-outline-dark m-2 mt-0 mb-0" type="submit">
                        Upload
                    </button>
                    <input type="hidden" value="{{ $item->checkoutCounter }}" name="checkoutCounter">
                </div>
                @elseif($item->status=='Waiting for payment' or $item->status=='Waiting for verification')
                <div class="d-flex mb-3 align-items-center">
                    <input class="form-control form-control-md" id="image" name="image" type="file">
                    <label class="m-2 mt-0 mb-0" for="image">Uploaded</label>
                    <button class="btn btn-outline-dark m-2 mt-0 mb-0" type="submit">
                        Reupload
                    </button>
                    <input type="hidden" value="{{ $item->checkoutCounter }}" name="checkoutCounter">
                </div>
                @else
                <div>
                    Uploaded
                </div>
                @endif
            </td>
        </form>
        
        <td data-th="Status">
            {{ $item->status }}
        </td>

        <form action="/viewDetail" method="post">
            @csrf
            <td class="actions" data-th="">
                <input name="checkoutCounter" type="hidden" value="{{ $item->checkoutCounter }}">
                <input name="order_id" type="hidden" value="{{ $item->id }}">
                <button class="btn btn-outline-info btn-lg" type="submit">
                    Details
                </button>
            </td>
        </form>

    </tr>
    @endforeach
  </tbody>
  <tfoot>
        <tr>
        </tr>
  </tfoot>
</table>

@endsection