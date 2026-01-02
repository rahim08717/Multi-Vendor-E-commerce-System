@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Shipping Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.place') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" required placeholder="017xxxxxxxx">
                        </div>

                        <div class="mb-3">
                            <label>Full Address</label>
                            <textarea name="address" class="form-control" rows="3" required placeholder="House, Road, Area, City"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100 mt-3">Place Order</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    {{ $details['name'] }}
                                    <small class="text-muted">x {{ $details['quantity'] }}</small>
                                </div>
                                <span>{{ $details['price'] * $details['quantity'] }} Tk</span>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold bg-light">
                            <span>Total Amount</span>
                            <span>{{ $total }} Tk</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
