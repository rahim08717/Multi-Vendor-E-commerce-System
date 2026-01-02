@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">

            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        @if ($product->image)
                            <img src="{{ asset('uploads/products/' . $product->image) }}" class="img-fluid"
                                alt="{{ $product->name }}" style="max-height: 400px;">
                        @else
                            <img src="https://via.placeholder.com/400" class="img-fluid" alt="No Image">
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="fw-bold">{{ $product->name }}</h2>
                        <p class="text-muted">Sold by: <span class="text-primary">{{ $product->seller->name }}</span></p>

                        <h3 class="text-success my-3">{{ $product->price }} Tk</h3>

                        <p class="lead">{{ $product->description }}</p>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Status:</strong>
                                @if ($product->stock > 0)
                                    <span class="badge bg-success">In Stock ({{ $product->stock }})</span>
                                @else
                                    <span class="badge bg-danger">Out of Stock</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-block">
                           
                                <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </a>

                            <a href="{{ route('front.home') }}" class="btn btn-outline-secondary btn-lg">Back to Shop</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
