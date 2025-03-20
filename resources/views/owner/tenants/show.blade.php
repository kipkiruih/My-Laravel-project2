@extends('layouts.owner')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="fas fa-user"></i> Tenant Details</h2>

    <div class="card shadow-sm">
        <div class="card-body text-center">
            <!-- Profile Image -->
            <img src="{{ $tenant->user->profile_image ? asset('storage/' . $tenant->user->profile_image) : asset('images/default-profile.png') }}" 
                 class="rounded-circle border" width="120" height="120" alt="Tenant Profile">

            <h3 class="mt-3 text-dark">{{ $tenant->user->name }}</h3>
            <p class="text-muted"><i class="fas fa-user-tag"></i> Tenant</p>

            <hr>

            <div class="row text-left">
                <div class="col-md-6">
                    <p><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $tenant->user->email }}</p>
                    <p><i class="fas fa-phone"></i> <strong>Phone:</strong> {{ $tenant->user->phone }}</p>
                </div>
                <div class="col-md-6">
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> {{ $tenant->address }}</p>
                    <p><i class="fas fa-calendar-alt"></i> <strong>Joined:</strong> {{ $tenant->user->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <hr>

            <!-- Action Buttons -->
            <a href="{{ route('owner.tenants.index') }}" class="btn" style="background-color: #7F8C8D; color: white;">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('owner.tenants.edit', $tenant->id) }}" class="btn" style="background-color: #F4A62A; color: white;">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('owner.tenants.destroy', $tenant->id) }}" method="POST" class="d-inline-block" 
                  onsubmit="return confirm('Are you sure you want to delete this tenant?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background-color: #2ECC71; color: white;">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
