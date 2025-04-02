@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #F4F6F7;">
    <div class="col-md-5 col-lg-5">
        <div class="card shadow-sm border-0 rounded">
            <!-- Header -->
            <div class="card-header text-center" style="background-color: #2C3E50; color: #FFFFFF; padding: 10px;">
                <h4 class="mb-1"><i class="fas fa-sign-in-alt"></i> Welcome Back</h4>
            </div>

            <!-- Login Form -->
            <div class="card-body p-3">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                        <input id="email" type="email" class="form-control custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <!-- Password with Visibility Toggle -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control custom-input @error('password') is-invalid @enderror" name="password" required>
                            <span class="input-group-text toggle-password"><i class="fas fa-eye"></i></span>
                        </div>
                        @error('password') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check small mb-3">
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
                            <a class="small text-gold" href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Footer -->
            <div class="card-footer text-center small p-2">
                @if (session('error'))
                    <!-- Reactivation Message -->
                    <div class="alert alert-danger mt-2 text-center">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>

                    <!-- Reactivation Form -->
                    <div class="card border-0 shadow-sm p-2 bg-light mt-2">
                        <h6 class="text-center mb-2"><i class="fas fa-user-lock"></i> Reactivate Your Account</h6>
                        <form action="{{ route('account.reactivate') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="email" name="email" class="form-control custom-input" placeholder="Enter your email" required>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-redo"></i> Reactivate</button>
                            </div>
                        </form>
                    </div>
                @endif

                Don't have an account? <a href="{{ route('register') }}" class="text-gold">Register</a>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styling -->
<style>
    /* Brand Colors */
    :root {
        --primary-color: #2C3E50; /* Royal Blue */
        --accent-color: #F4A62A; /* Gold */
        --success-color: #2ECC71; /* Emerald Green */
        --hover-success: #27AE60;
        --text-gray: #7F8C8D;
    }

    /* Custom Input Styling */
    .custom-input {
        border: 1px solid var(--text-gray);
        border-radius: 5px;
        padding: 8px;
        transition: all 0.3s ease-in-out;
    }

    .custom-input:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 5px rgba(244, 166, 42, 0.5);
    }

    /* Login Button */
    .login-btn {
        background-color: var(--success-color);
        color: white;
        font-size: 0.9rem;
        padding: 8px;
        border: none;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }

    .login-btn:hover {
        background-color: var(--hover-success);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    /* Gold Text */
    .text-gold {
        color: var(--accent-color) !important;
    }

    /* Password Visibility Icon */
    .toggle-password {
        cursor: pointer;
        background: var(--primary-color);
        color: white;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }

    .toggle-password:hover {
        background: var(--accent-color);
        color: white;
    }
</style>

<!-- Password Visibility Toggle -->
<script>
    document.querySelector('.toggle-password').addEventListener('click', function () {
        let passwordField = document.getElementById('password');
        let icon = this.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
@endsection
