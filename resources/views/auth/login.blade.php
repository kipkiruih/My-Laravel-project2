@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #F4F6F7;">
    <div class="col-md-5 col-lg-5"> <!-- Reduced width -->
        <div class="card shadow-sm border-0 rounded">
            <!-- Header -->
            <div class="card-header text-center" style="background-color: #2C3E50; color: #FFFFFF; padding: 10px;">
                <h4 class="mb-1"><i class="fas fa-sign-in-alt"></i> Welcome Back</h4>
            </div>

            <!-- Login Form -->
            <div class="card-body p-3"> <!-- Reduced padding -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group mb-2">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                        <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-2">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required>
                        @error('password') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check small mb-2">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember"> Remember Me </label>
                    </div>

                    <!-- Login Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn login-btn">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </div>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <div class="text-center mt-2">
                            <a class="small text-primary" href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Footer -->
            <div class="card-footer text-center small p-2">
                Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register</a>
            </div>
        </div>
    </div>
</div>

<!-- Custom Hover Effect -->
<style>
    .login-btn {
        background-color: #2ECC71; /* Emerald Green */
        color: white;
        font-size: 0.9rem;
        padding: 8px;
        border: none;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }

    .login-btn:hover {
        background-color: #27AE60; /* Darker Green */
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }
</style>

@endsection
