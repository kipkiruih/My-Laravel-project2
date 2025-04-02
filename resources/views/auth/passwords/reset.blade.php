@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center fw-bold fs-4">
                    <i class="fas fa-lock"></i> Reset Password
                </div>
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}" onsubmit="return validatePassword()">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold text-dark">Email Address</label>
                            <input id="email" type="email" class="form-control border-secondary @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Field with Visibility Toggle -->
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label fw-bold text-dark">New Password</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control border-secondary @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password', 'togglePasswordIcon')">
                                    <i id="togglePasswordIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small id="passwordHelp" class="text-danger"></small>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password Field with Visibility Toggle -->
                        <div class="mb-3 position-relative">
                            <label for="password-confirm" class="form-label fw-bold text-dark">Confirm Password</label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control border-secondary" name="password_confirmation" required autocomplete="new-password">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password-confirm', 'toggleConfirmPasswordIcon')">
                                    <i id="toggleConfirmPasswordIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-bold py-2">
                                <i class="fas fa-key"></i> Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Password Strength and Visibility -->
<script>
function togglePassword(fieldId, iconId) {
    let passwordField = document.getElementById(fieldId);
    let icon = document.getElementById(iconId);

    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

document.getElementById('password').addEventListener('input', function () {
    let password = this.value;
    let message = '';

    if (password.length < 8) {
        message = 'Password must be at least 8 characters.';
    } else if (!/[A-Z]/.test(password)) {
        message = 'Include at least one uppercase letter.';
    } else if (!/[a-z]/.test(password)) {
        message = 'Include at least one lowercase letter.';
    } else if (!/\d/.test(password)) {
        message = 'Include at least one number.';
    } else if (!/[@$!%*?&]/.test(password)) {
        message = 'Include at least one special character (@$!%*?&).';
    } else {
        message = 'Strong password!';
        document.getElementById('passwordHelp').classList.remove('text-danger');
        document.getElementById('passwordHelp').classList.add('text-success');
    }

    document.getElementById('passwordHelp').textContent = message;
});

function validatePassword() {
    let password = document.getElementById('password').value;
    let message = '';

    if (password.length < 8 || !/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/\d/.test(password) || !/[@$!%*?&]/.test(password)) {
        alert('Your password does not meet the required strength criteria.');
        return false;
    }
    return true;
}
</script>

@endsection
