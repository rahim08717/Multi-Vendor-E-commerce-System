@extends('layouts.seller')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Seller Dashboard</h3>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white shadow h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase small font-weight-bold">My Products</div>
                            <div class="h2 mb-0 font-weight-bold">{{ $totalProducts }}</div>
                        </div>
                        <i class="fas fa-box-open fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white shadow h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase small font-weight-bold">Items Sold</div>
                            <div class="h2 mb-0 font-weight-bold">{{ $totalSoldItems }}</div>
                        </div>
                        <i class="fas fa-shipping-fast fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white shadow h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase small font-weight-bold">Total Earnings</div>
                            <div class="h2 mb-0 font-weight-bold">{{ number_format($totalEarnings) }} Tk</div>
                        </div>
                        <i class="fas fa-wallet fa-3x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card mt-4 shadow">
        <div class="card-body">
            <h4>Welcome back, {{ Auth::user()->name }}!</h4>
            <p>Use the sidebar menu to manage your products and view orders.</p>
        </div>
    </div>
</div>
@endsection
