@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Shopping Cart</h2>

        @if (session('cart'))
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp

                        @foreach (session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr>
                                <td style="width: 100px;">
                                    @if ($details['image'])
                                        <img src="{{ asset('uploads/products/' . $details['image']) }}"
                                            class="img-fluid rounded" width="80">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td class="align-middle">{{ $details['name'] }}</td>
                                <td class="align-middle">{{ $details['price'] }} Tk</td>
                                <td class="align-middle">
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control"
                                        style="width: 80px;" min="1">
                                </td>
                                <td class="align-middle">{{ $details['price'] * $details['quantity'] }} Tk</td>
                                <td class="align-middle">
                                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total:</td>
                            <td colspan="2" class="fw-bold">{{ $total }} Tk</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('front.home') }}" class="btn btn-secondary">Continue Shopping</a>
                <a href="{{ route('checkout.index') }}" class="btn btn-success">Proceed to Checkout</a>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <h4>Your cart is empty!</h4>
                <a href="{{ route('front.home') }}" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        @endif
    </div>
@endsection
