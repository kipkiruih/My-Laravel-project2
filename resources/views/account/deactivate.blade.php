@extends('layouts.app')

@section('title', 'Deactivate Account')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h4>Deactivate Your Account</h4>
        </div>
        <div class="card-body">
            <p class="text-muted">
                Are you sure you want to deactivate your account? You won’t be able to log in until you reactivate it.
            </p>
            <p class="text-danger">
                <strong>Note:</strong> Your data will be saved, and you can reactivate your account anytime.
            </p>

            <form action="{{ route('account.deactivate') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-exclamation-triangle"></i> Deactivate Account
                </button>
                
                @php
                    $dashboardRoute = auth()->user()->role === 'admin' ? 'admin.dashboard' 
                        : (auth()->user()->role === 'owner' ? 'owner.dashboard' 
                        : (auth()->user()->role === 'tenant' ? 'tenant.dashboard' 
                        : 'dashboard'));
                @endphp
                
                <a href="{{ route($dashboardRoute) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
