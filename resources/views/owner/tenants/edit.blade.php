@extends('layouts.owner')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="fas fa-user-edit"></i> Edit Tenant</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('owner.tenants.update', $tenant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Profile Image -->
                <div class="text-center mb-4">
                    <img src="{{ $tenant->user->profile_image ? asset('storage/' . $tenant->user->profile_image) : asset('images/default-user.png') }}" 
                         class="rounded-circle border" width="120" height="120" alt="Tenant Profile">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label for="name"><i class="fas fa-user"></i> Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" 
                                   value="{{ old('name', $tenant->user->name) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" 
                                   value="{{ old('email', $tenant->user->email) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Phone -->
                        <div class="form-group mb-3">
                            <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control" 
                                   value="{{ old('phone', $tenant->user->phone) }}" required>
                        </div>

                        <!-- Address -->
                        <div class="form-group mb-3">
                            <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                            <input type="text" id="address" name="address" class="form-control" 
                                   value="{{ old('address', $tenant->address) }}" required>
                        </div>
                    </div>
                </div>

                <!-- Profile Image Upload -->
                <div class="form-group mb-3">
                    <label for="profile_image"><i class="fas fa-image"></i> Profile Image</label>
                    <input type="file" id="profile_image" name="profile_image" class="form-control">
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('owner.tenants.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update Tenant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
