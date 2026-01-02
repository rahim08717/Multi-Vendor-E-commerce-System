@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3>Edit Role: {{ ucfirst($role->name) }}</h3>

    <div class="card shadow mt-3">
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Role Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                </div>

                <h5 class="mt-4">Assign Permissions</h5>
                <div class="row">
                    @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permission->name }}"
                                   id="perm_{{ $permission->id }}"
                                   {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                            <label class="form-check-label" for="perm_{{ $permission->id }}">
                                {{ ucfirst($permission->name) }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-success mt-4">Update Permissions</button>
            </form>
        </div>
    </div>
</div>
@endsection
