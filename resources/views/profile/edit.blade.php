@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-royal-blue text-white text-center">
                    <h4><i class="fas fa-user-edit"></i> Update Profile</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile Image -->
                        <div class="text-center mb-3">
                            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-profile.png') }}" 
                                 class="rounded-circle shadow" width="120" height="120" alt="Profile Image">
                            <div class="mt-2">
                                <label class="btn btn-outline-warm-gray btn-sm">
                                    <i class="fas fa-camera"></i> Change Profile Image
                                    <input type="file" name="profile_image" hidden>
                                </label>
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label text-warm-gray"><i class="fas fa-user"></i> Name</label>
                            <input type="text" name="name" class="form-control border-royal-blue" value="{{ Auth::user()->name }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label text-warm-gray"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control border-royal-blue" value="{{ Auth::user()->email }}" required>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label text-warm-gray"><i class="fas fa-phone"></i> Phone</label>
                            <input type="text" name="phone" class="form-control border-royal-blue" value="{{ Auth::user()->phone }}" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label text-warm-gray"><i class="fas fa-lock"></i> New Password (Leave blank if not changing)</label>
                            <input type="password" name="password" class="form-control border-royal-blue">
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label class="form-label text-warm-gray"><i class="fas fa-key"></i> Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control border-royal-blue">
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-warm-gray">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .bg-royal-blue { background-color: #2C3E50 !important; } /* Header Background */
    .text-warm-gray { color: #7F8C8D !important; } /* Labels */
    .border-royal-blue { border-color: #2C3E50 !important; } /* Input Borders */
    
    /* Submit Button */
    .btn-warm-gray { background-color: #7F8C8D !important; color: white; }
    .btn-warm-gray:hover { background-color: #5c6769 !important; color: white !important; } /* Darker Warm Gray */
    
    /* Outline Button */
    .btn-outline-warm-gray { border: 1px solid #7F8C8D; color: #7F8C8D; background: transparent; }
    .btn-outline-warm-gray:hover { background-color: #2C3E50 !important; color: white !important; } /* Royal Blue Hover */
</style>
@endsection
