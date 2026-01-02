@extends('layouts.seller')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Product</div>

                <div class="card-body">
                   <form action="{{ route('seller.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Price (Tk)</label>
                                <input type="number" name="price" class="form-control" step="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Stock Quantity</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Product Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
