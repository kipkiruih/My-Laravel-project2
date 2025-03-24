@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%; border-radius: 10px;">
        <h2 class="text-center mb-4" style="color: #2C3E50;">Register</h2>

        <!-- Progress Indicator -->
        <div class="progress mb-3">
            <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 50%; background-color: #F4A62A;">Step 1 of 2</div>
        </div>

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Step 1: Personal Information -->
            <div id="step-1">
                <div class="mb-3">
                    <label for="name" class="form-label"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Enter full name">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Enter email">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label"><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" required placeholder="Enter phone number">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label"><i class="fas fa-user-tag"></i> Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="tenant">Tenant</option>
                        <option value="owner">Owner</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="button" class="btn w-100 next-btn" style="background-color: #2ECC71; color: white;">Next</button>
            </div>

            <!-- Step 2: Profile & Password Setup -->
            <div id="step-2" style="display: none;">
                <div class="mb-3">
                    <label for="profile_image" class="form-label"><i class="fas fa-image"></i> Profile Image</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                </div>

                <div class="mb-3 position-relative">
                    <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Enter password">
                        <button class="btn btn-outline-secondary toggle-password" type="button">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3 position-relative">
                    <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i> Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Confirm password">
                        <button class="btn btn-outline-secondary toggle-password" type="button">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="button" class="btn w-100 back-btn" style="background-color: #7F8C8D; color: white;">Back</button>
                <button type="submit" class="btn w-100 mt-2" style="background-color: #F4A62A; color: white;">Register</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let step1 = document.getElementById("step-1");
        let step2 = document.getElementById("step-2");
        let progressBar = document.getElementById("progress-bar");

        document.querySelector(".next-btn").addEventListener("click", function() {
            step1.style.display = "none";
            step2.style.display = "block";
            progressBar.style.width = "100%";
            progressBar.textContent = "Step 2 of 2";
        });

        document.querySelector(".back-btn").addEventListener("click", function() {
            step1.style.display = "block";
            step2.style.display = "none";
            progressBar.style.width = "50%";
            progressBar.textContent = "Step 1 of 2";
        });

        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
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
    });
</script>

@endsection
