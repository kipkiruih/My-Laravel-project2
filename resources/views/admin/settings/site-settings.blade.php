@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-cogs"></i> Site Settings</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ url('/admin/site-settings') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-globe"></i> Site Name</label>
                    <input type="text" class="form-control" name="site_name" value="{{ $settings->site_name ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $settings->email ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-phone"></i> Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $settings->phone ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $settings->address ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-image"></i> Logo</label>
                    <input type="file" class="form-control" name="logo">
                    @if(isset($settings->logo))
                        <img src="{{ asset('storage/logos/' . $settings->logo) }}" alt="Site Logo" width="100" class="mt-2">
                    @endif
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
