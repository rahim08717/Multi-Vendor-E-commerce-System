@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">System Activity Logs</h3>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Date & Time</th> <th>Name</th>        <th>Role</th>        <th>Description</th> </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('d M Y, h:i A') }}</td>

                        <td>{{ $log->name }}</td>

                        <td>
                            @if($log->role == 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($log->role == 'seller')
                                <span class="badge bg-success">Seller</span>
                            @else
                                <span class="badge bg-primary">Customer</span>
                            @endif
                        </td>

                        <td>{{ $log->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
