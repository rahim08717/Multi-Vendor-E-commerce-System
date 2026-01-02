@extends('layouts.seller')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Order Management</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customer Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Customer Info</th>
                            <th>Date</th>
                            <th style="width: 200px;">Update Status</th> </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $item)
                        <tr>
                            <td>#{{ $item->order->id }}</td>

                            <td>
                                <div class="d-flex align-items-center">
                                    @if($item->product->image)
                                        <img src="{{ asset('uploads/products/' . $item->product->image) }}" width="40" height="40" class="rounded mr-2" style="object-fit: cover;">
                                    @else
                                        <span class="badge badge-secondary mr-2">No Img</span>
                                    @endif
                                    <span>{{ Str::limit($item->product->name, 20) }}</span>
                                </div>
                            </td>

                            <td>{{ $item->quantity }}</td>

                            <td class="font-weight-bold text-success">
                                {{ number_format($item->price * $item->quantity) }} Tk
                            </td>

                            <td>
                                <strong>{{ $item->order->name }}</strong><br>
                                <small class="text-muted">{{ $item->order->phone }}</small><br>
                                <small>{{ Str::limit($item->order->address, 20) }}</small>
                            </td>

                            <td>{{ $item->created_at->diffForHumans() }}</td>

                            <td>
                                <form action="{{ route('seller.order.update', $item->order->id) }}" method="POST">
                                    @csrf
                                    <div class="input-group input-group-sm">
                                        <select name="status" class="form-control" style="font-size: 12px;">
                                            <option value="pending" {{ $item->order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $item->order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $item->order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ $item->order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="cancelled" {{ $item->order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-check"></i> update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="mt-1">
                                    <span class="badge badge-{{ $item->order->status == 'pending' ? 'warning' : ($item->order->status == 'delivered' ? 'success' : 'info') }}">
                                        Current: {{ ucfirst($item->order->status) }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($orders->count() == 0)
                    <div class="alert alert-info text-center mt-3">No orders found yet!</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
