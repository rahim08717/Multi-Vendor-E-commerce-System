@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3>Role Management</h3>
    <div class="card shadow mt-3">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ ucfirst($role->name) }}</td>
                        <td>
                            @foreach($role->permissions as $perm)
                                <span class="badge bg-info text-dark">{{ $perm->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">Manage Permissions</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
