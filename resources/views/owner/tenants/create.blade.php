@extends('layouts.owner')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="fas fa-user-plus"></i> Add New Tenant</h2>

    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ route('owner.tenants.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Profile Image Upload --}}
                <div class="text-center mb-3">
                    <label for="profile_image" class="form-label">
                        <img id="preview-image" src="{{ asset('images/default-user.png') }}" class="rounded-circle" width="100" height="100" style="cursor:pointer;">
                    </label>
                    <input type="file" name="profile_image" id="profile_image" class="d-none" onchange="previewImage(event)">
                </div>

                {{-- Full Name --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter full name" value="{{ old('name') }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Phone Number --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone') }}" required>
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Address Field --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Enter tenant's address" value="{{ old('address') }}" required>
                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-lock"></i> Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                </div>

                {{-- Submit Button --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('owner.tenants.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Tenant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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
