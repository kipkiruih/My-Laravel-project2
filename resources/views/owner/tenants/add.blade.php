@extends('layouts.owner')

@section('content')
<div class="container">
    <h2 class="mb-4 text-dark" style="color: #2C3E50;">
        <i class="fas fa-user-plus"></i> Add New Tenant
    </h2>

    <div class="card shadow-sm" style="background-color: #F8F9FA;">
        <div class="card-body">
            <form action="{{ route('owner.tenants.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Profile Image Upload --}}
                <div class="text-center mb-4">
                    <label for="profile_image" class="form-label">
                        <img id="preview-image" src="{{ asset('images/default-user.png') }}" class="rounded-circle border shadow-sm" 
                             width="100" height="100" style="cursor:pointer;">
                    </label>
                    <input type="file" name="profile_image" id="profile_image" class="d-none" onchange="previewImage(event)">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        {{-- Full Name --}}
                        <div class="mb-3">
                            <label class="form-label" style="color: #2C3E50;"><i class="fas fa-user"></i> Full Name</label>
                            <input type="text" name="name" class="form-control border-gray" 
                                   placeholder="Enter full name" value="{{ old('name') }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label" style="color: #2C3E50;"><i class="fas fa-envelope"></i> Email Address</label>
                            <input type="email" name="email" class="form-control border-gray" 
                                   placeholder="Enter email" value="{{ old('email') }}" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div class="mb-3">
                            <label class="form-label" style="color: #2C3E50;"><i class="fas fa-phone"></i> Phone Number</label>
                            <input type="text" name="phone" class="form-control border-gray" 
                                   placeholder="Enter phone number" value="{{ old('phone') }}" required>
                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- Address Field --}}
                        <div class="mb-3">
                            <label class="form-label" style="color: #2C3E50;"><i class="fas fa-map-marker-alt"></i> Address</label>
                            <input type="text" name="address" class="form-control border-gray" 
                                   placeholder="Enter tenant's address" value="{{ old('address') }}" required>
                            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label" style="color: #2C3E50;"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" name="password" class="form-control border-gray" 
                                   placeholder="Enter password" required>
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label" style="color: #2C3E50;"><i class="fas fa-lock"></i> Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control border-gray" 
                                   placeholder="Confirm password" required>
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('owner.tenants.index') }}" class="btn cancel-btn">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                    <button type="submit" class="btn save-btn">
                        <i class="fas fa-save"></i> Save Tenant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Custom Styling for Buttons and Form Fields --}}
<style>
    .border-gray {
        border-color: #7F8C8D !important; /* Warm Gray */
    }

    .cancel-btn {
        background-color: #7F8C8D; /* Warm Gray */
        color: white;
        transition: background-color 0.3s ease;
    }
    
    .cancel-btn:hover {
        background-color: #6C757D; /* Darker Gray */
        color: white;
    }

    .save-btn {
        background-color: #2ECC71; /* Emerald Green */
        color: white;
        transition: background-color 0.3s ease;
    }

    .save-btn:hover {
        background-color: #27AE60; /* Darker Emerald Green */
        color: white;
    }
</style>

{{-- Image Preview Script --}}
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('preview-image').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
