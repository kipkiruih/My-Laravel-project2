@extends('layouts.owner')

@section('content')
<div class="container">
    <h2 class="mb-4">Tenant Management</h2>
    <a href="{{ route('owner.tenants.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-user-plus"></i> Add Tenant
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenants as $tenant)
    <tr>
        <td><img src="{{ $tenant->user->profile_image ? asset('storage/' . $tenant->user->profile_image) : asset('images/default-user.png') }}" width="50" height="50" class="rounded-circle"></td>
        <td>{{ $tenant->user->name }}</td>
        <td>{{ $tenant->user->email }}</td>
        <td>{{ $tenant->user->phone }}</td>
        <td>{{ $tenant->address }}</td>
        <td>
            <a href="{{ route('owner.tenants.show', $tenant->id) }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i> View
            </a>
            <form action="{{ route('owner.tenants.destroy', $tenant->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </form>
        </td>
    </tr>
@endforeach

                </tbody>
            </table>
            {{ $tenants->links() }}
        </div>
    </div>
</div>
@endsection
