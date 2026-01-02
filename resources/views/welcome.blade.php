@extends('layouts.app')

@section('content')
<div class="container">

    <div class="text-center mb-5">
        <h1>Welcome to Our E-Commerce Shop</h1>
        <p class="lead">Find the best products at the best prices!</p>
    </div>

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <div style="height: 200px; overflow: hidden;" class="d-flex align-items-center justify-content-center bg-light">
                    @if($product->image)
                        <img src="{{ asset('uploads/products/' . $product->image) }}" class="card-img-top" style="height: 100%; width: auto;" alt="{{ $product->name }}">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </div>

                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>

                    <p class="card-text text-primary fw-bold">{{ $product->price }} Tk</p>

                    <a href="{{ route('product.details', $product->id) }}" class="btn btn-outline-dark w-100">View Details</a>
                </div>
            </div>
        </div>
        @endforeach

        @if($products->count() == 0)
            <div class="col-12 text-center">
                <div class="alert alert-warning">No products found!</div>
            </div>
        @endif
    </div>
</div>
@endsection
