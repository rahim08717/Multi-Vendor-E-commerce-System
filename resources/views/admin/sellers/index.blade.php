@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Manage Sellers</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined Date</th>
                        <th>Current Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sellers as $seller)
                    <tr>
                        <td>{{ $seller->name }}</td>
                        <td>{{ $seller->email }}</td>
                        <td>{{ $seller->created_at->format('d M Y') }}</td>

                        <td>
                            @if($seller->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Banned</span>
                            @endif
                        </td>

                        <td>
                            @if($seller->status == 'active')
                                <a href="{{ route('admin.seller.status', $seller->id) }}"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure you want to BAN this seller?')">
                                   Ban Seller
                                </a>
                            @else
                                <a href="{{ route('admin.seller.status', $seller->id) }}"
                                   class="btn btn-sm btn-success"
                                   onclick="return confirm('Activate this seller?')">
                                   Activate Seller
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
