@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #F4F6F7;">
    <div class="col-md-6 col-lg-5"> <!-- Reduced width -->
        <div class="card shadow-sm border-0 rounded">
            <!-- Header -->
            <div class="card-header text-center" style="background-color: #2C3E50; color: #FFFFFF; padding: 10px;">
                <h4 class="mb-1"><i class="fas fa-user-plus"></i> Sign Up</h4>
            </div>

            <!-- Registration Form -->
            <div class="card-body p-3"> <!-- Reduced padding -->
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="form-group mb-2">
                        <label for="name" class="form-label"><i class="fas fa-user"></i> Name</label>
                        <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-2">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                        @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <!-- Phone -->
                    <div class="form-group mb-2">
                        <label for="phone" class="form-label"><i class="fas fa-phone"></i> Phone</label>
                        <input id="phone" type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                        @error('phone') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <!-- Role -->
                    <div class="form-group mb-2">
                        <label for="role" class="form-label"><i class="fas fa-user-tag"></i> Role</label>
                        <select id="role" class="form-control form-control-sm @error('role') is-invalid @enderror" name="role" required>
                            <option value="">Select Role</option>
                            <option value="tenant">Tenant</option>
                            <option value="owner">Property Owner</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <!-- Profile Image -->
                    <div class="form-group mb-2">
                        <label for="profile_image" class="form-label"><i class="fas fa-image"></i> Profile Image</label>
                        <input id="profile_image" type="file" class="form-control form-control-sm @error('profile_image') is-invalid @enderror" name="profile_image">
                        @error('profile_image') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-2">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required>
                        @error('password') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mb-3">
                        <label for="password-confirm" class="form-label"><i class="fas fa-lock"></i> Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required>
                    </div>

                    <!-- Register Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn register-btn">
                            <i class="fas fa-user-plus"></i> Register
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="card-footer text-center small p-2">
                Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
            </div>
        </div>
    </div>
</div>

<!-- Custom Hover Effect -->
<style>
    .register-btn {
        background-color: #2ECC71; /* Emerald Green */
        color: white;
        font-size: 0.9rem;
        padding: 8px;
        border: none;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }

    .register-btn:hover {
        background-color: #27AE60; /* Darker Green */
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }
</style>

@endsection
