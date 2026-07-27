@extends('layouts.app')

@section('content')
<h1>Users</h1>

@if (session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif
{{--search bar--}}
<form method="GET" action="{{ route('users.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control"
               placeholder="Search by name or email..."
               value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->roles->pluck('name')->join(', ') }}</td>
                        <td>
                            @if ($u->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if (auth()->user()->hasPermission('edit_users'))
                                <a href="{{ route('users.edit', $u->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                                <form action="{{ route('users.toggle', $u->id) }}" method="POST" class="d-inline">
                 @csrf
             @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-warning">
                                        {{ $u->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            @endif

                            @if (auth()->user()->hasPermission('delete_users') && $u->id !== auth()->id())
                                <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this user? This cannot be undone.')">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if (auth()->user()->hasPermission('create_users'))
    <a href="{{ route('users.create') }}" class="btn btn-primary mt-3">+ Add User</a>
@endif

@endsection
