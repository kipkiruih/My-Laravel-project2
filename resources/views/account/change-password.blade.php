@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <!-- Header -->
                <div class="card-header text-white text-center" style="background-color: #2ECC71;">
                    <h4><i class="fas fa-key"></i> Change Password</h4>
                </div>
                
                <div class="card-body">
                    <!-- Success & Error Messages -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Change Password Form -->
                    <form method="POST" action="{{ route('changePassword') }}">
                        @csrf

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label"><i class="fas fa-lock"></i> Current Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control border-gray" id="current_password" name="current_password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label"><i class="fas fa-lock"></i> New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control border-gray" id="new_password" name="new_password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label"><i class="fas fa-lock"></i> Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control border-gray" id="new_password_confirmation" name="new_password_confirmation" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Update Button -->
                        <button type="submit" class="btn custom-btn w-100"><i class="fas fa-save"></i> Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .border-gray { border: 1px solid #7F8C8D; } /* Warm Gray Borders */
    .custom-btn {
        background-color: #2ECC71; /* Emerald Green */
        color: white;
        font-weight: bold;
        transition: background-color 0.3s ease-in-out;
    }
    .custom-btn:hover {
        background-color: #27AE60; /* Darker Green on Hover */
    }
</style>

<!-- Password Toggle Script -->
<script>
    document.querySelectorAll(".toggle-password").forEach(button => {
        button.addEventListener("click", function () {
            let input = this.previousElementSibling;
            if (input.type === "password") {
                input.type = "text";
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                input.type = "password";
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    });
</script>

@endsection
