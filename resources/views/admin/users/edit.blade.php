@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center" style="color: #2C3E50;">
            <i class="fas fa-user-edit"></i> Edit User
        </h2>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="fw-bold"><i class="fas fa-user"></i> Name</label>
                <input type="text" name="name" class="form-control border-2" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label class="fw-bold"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" name="email" class="form-control border-2" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label class="fw-bold"><i class="fas fa-user-tag"></i> Role</label>
                <select name="role" class="form-control border-2">
                    <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
                    <option value="tenant" {{ $user->role == 'tenant' ? 'selected' : '' }}>Tenant</option>
                    <option value="agent" {{ $user->role == 'agent' ? 'selected' : '' }}>Agent</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <!-- Back Button -->
                <a href="{{ route('admin.users.index') }}" class="btn custom-btn-gray">
                    <i class="fas fa-arrow-left"></i> Back
                </a>

                <!-- Save Button -->
                <button type="submit" class="btn custom-btn-gold">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Custom Button Styles -->
<style>
    /* Back Button */
    .custom-btn-gray {
        background-color: #7F8C8D;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .custom-btn-gray:hover {
        background-color: #5E6C70; /* Darker gray for contrast */
        color: white;
        transform: scale(1.05);
    }

    /* Save Button */
    .custom-btn-gold {
        background-color: #F4A62A;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .custom-btn-gold:hover {
        background-color: #D18A1B; /* Slightly deeper gold */
        color: white;
        transform: scale(1.05);
    }
</style>
@endsection
