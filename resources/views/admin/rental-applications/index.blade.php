@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary"><i class="fas fa-file-signature"></i> Rental Applications Monitoring</h2>
        
        <!-- Search Bar -->
        <form action="{{ route('admin.rental-applications.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search Tenant or Property..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-gold"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <!-- Applications Table -->
    <div class="card shadow-lg p-3" style="border-radius: 12px;">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>#</th>
                        <th><i class="fas fa-user"></i> Tenant</th>
                        <th><i class="fas fa-home"></i> Property</th>
                        <th><i class="fas fa-user-tie"></i> Owner</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $application->tenant?->name ?? 'N/A' }}</td>
                            <td>{{ $application->property?->title ?? 'N/A' }}</td>
                            <td>{{ $application->property?->owner?->name ?? 'N/A' }}</td>
                            <td>
                                <span class="badge 
                                    {{ $application->status == 'approved' ? 'bg-emerald' : 
                                       ($application->status == 'rejected' ? 'bg-danger' : 
                                       ($application->status == 'pending' ? 'bg-gold' : 'bg-secondary')) }}">
                                    <i class="fas 
                                        {{ $application->status == 'approved' ? 'fa-check-circle' : 
                                           ($application->status == 'rejected' ? 'fa-times-circle' : 
                                           'fa-hourglass-half') }}"></i>
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.rental-applications.show', $application->id) }}" class="btn btn-gray btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted"><i class="fas fa-exclamation-circle"></i> No rental applications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom Styling -->
<style>
    .text-primary {
        color: #2C3E50 !important; /* Brand Primary Blue */
    }

    .bg-primary {
        background-color: #2C3E50 !important; /* Brand Primary Blue */
    }

    .form-control {
        border-radius: 8px;
        padding-left: 10px;
        border: 2px solid #7F8C8D; /* Warm Gray */
    }

    .btn {
        border-radius: 6px;
        transition: all 0.3s ease-in-out;
        font-weight: bold;
    }

    .btn-gold {
        background-color: #F4A62A; /* Gold */
        color: #FFFFFF;
    }

    .btn-gold:hover {
        background-color: #D98E1F; /* Darker Gold */
        transform: scale(1.05);
    }

    .btn-gray {
        background-color: #7F8C8D; /* Neutral Warm Gray */
        color: #FFFFFF;
    }

    .btn-gray:hover {
        background-color: #6C757D;
        transform: scale(1.05);
    }

    .bg-emerald {
        background-color: #2ECC71 !important; /* Emerald Green */
        color: white;
    }

    .bg-gold {
        background-color: #F4A62A !important; /* Gold */
        color: white;
    }

    .card {
        border: 2px solid #7F8C8D; /* Warm Gray */
    }
</style>
@endsection
