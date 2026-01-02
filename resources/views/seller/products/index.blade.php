@extends('layouts.seller')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>My Products</h4>
                        @can('create product')
                            <a href="{{ route('seller.product.create') }}" class="btn btn-primary">Add New Product</a>
                        @endcan
                    </div>

                    <td>
                        @can('edit product')
                            <a href="{{ route('seller.products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                        @endcan

                        @can('delete product')
                            <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endcan
                    </td>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->image)
                                                <img src="{{ asset('uploads/products/' . $product->image) }}" width="50"
                                                    alt="Product Image">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }} Tk</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            @if ($product->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
