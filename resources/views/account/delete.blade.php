@extends('layouts.app')

@section('title', 'Delete Account')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h4>Delete Your Account</h4>
        </div>
        <div class="card-body">
            <p class="text-muted">
                Are you sure you want to permanently delete your account? This action <strong>cannot</strong> be undone.
            </p>
            <p class="text-danger">
                <strong>Warning:</strong> All your data will be erased, and you won’t be able to recover it.
            </p>

            <form action="{{ route('account.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i> Delete My Account
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
