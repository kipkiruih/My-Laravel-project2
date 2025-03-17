@extends('layouts.owner')

@section('content')
<div class="container">
    <h2 class="mb-4 text-dark"><i class="fas fa-users"></i> Tenant Management</h2>
    
    <a href="{{route('owner.tenants.add')}}" class="btn btn-dark mb-3">
        <i class="fas fa-user-plus"></i> Add Tenant
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="bg-dark text-white">
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
                            <td>
                                <img src="{{ $tenant->user->profile_image ? asset('storage/' . $tenant->user->profile_image) : asset('images/default-user.png') }}" 
                                     width="45" height="45" class="rounded-circle border">
                            </td>
                            <td class="text-dark">{{ $tenant->user->name }}</td>
                            <td>{{ $tenant->user->email }}</td>
                            <td>{{ $tenant->user->phone }}</td>
                            <td>{{ $tenant->address }}</td>
                            <td>
                                <a href="{{ route('owner.tenants.show', $tenant->id) }}" class="btn btn-secondary btn-sm">
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
            <div class="d-flex justify-content-center mt-3">
                {{ $tenants->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
