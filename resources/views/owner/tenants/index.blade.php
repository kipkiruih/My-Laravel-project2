@extends('layouts.owner')

@section('content')
<div class="container">
    <h2 class="mb-4 text-dark">
        <i class="fas fa-users"></i> Tenant Management
    </h2>
    
    <a href="{{ route('owner.tenants.add') }}" class="btn btn-dark mb-3">
        <i class="fas fa-user-plus"></i> Add Tenant
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Search Bar (Right Aligned) -->
            <form action="{{ route('owner.tenants.index') }}" method="GET" class="mb-3">
                <div class="d-flex justify-content-end">
                    <div class="input-group" style="max-width: 300px;">
                        <input type="text" name="search" class="form-control form-control-sm" 
                            placeholder="Search tenants..." value="{{ request('search') }}">
                        <button class="btn btn-dark btn-sm" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <table class="table table-hover align-middle">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th><i class="fas fa-image"></i> Profile</th>
                        <th>
                            <a href="{{ route('owner.tenants.index', ['sort' => 'tenants.name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-dark text-decoration-none">
                                <i class="fas fa-user"></i> Name <i class="fas fa-sort"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('owner.tenants.index', ['sort' => 'users.email', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-dark text-decoration-none">
                                <i class="fas fa-envelope"></i> Email <i class="fas fa-sort"></i>
                            </a>
                        </th>
                        <th><i class="fas fa-phone"></i> Phone</th>
                        <th><i class="fas fa-map-marker-alt"></i> Address</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse($tenants as $index => $tenant)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <!-- Profile Image with Default -->
                            <td>
                                <img src="{{ $tenant->user->profile_image ? asset('storage/' . $tenant->user->profile_image) : asset('images/default-profile.png') }}" 
                                     alt="Profile Image" class="rounded-circle" width="40" height="40">
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
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <i class="fas fa-exclamation-circle"></i> No tenants found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $tenants->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
