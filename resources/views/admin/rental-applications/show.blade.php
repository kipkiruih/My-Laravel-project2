@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%; border-radius: 12px; border: 2px solid #7F8C8D;">
        <h2 class="mb-4 text-custom-blue text-center"><i class="fas fa-info-circle"></i> Application Details</h2>

        <div class="card-body">
            <h4 class="card-title mb-3"><i class="fas fa-home text-gold"></i> Property: <span class="fw-bold">{{ $application->property?->title ?? 'N/A' }}</span></h4>
    
            <p class="card-text"><strong><i class="fas fa-user text-custom-blue"></i> Tenant:</strong> {{ $application->tenant?->name ?? 'N/A' }}</p>
    
            <p class="card-text"><strong><i class="fas fa-user-tie text-custom-blue"></i> Owner:</strong> {{ $application->property?->owner?->name ?? 'N/A' }}</p> 
    
            <p class="card-text">
                <strong><i class="fas fa-clipboard-check text-gold"></i> Status:</strong> 
                <span class="badge 
                    {{ $application->status == 'approved' ? 'bg-emerald' : 
                       ($application->status == 'rejected' ? 'bg-red' : 
                       ($application->status == 'pending' ? 'bg-orange' : 'bg-gray')) }}">
                    <i class="fas 
                        {{ $application->status == 'approved' ? 'fa-check-circle' : 
                           ($application->status == 'rejected' ? 'fa-times-circle' : 
                           'fa-hourglass-half') }}"></i> 
                    {{ ucfirst($application->status) }}
                </span>
            </p>

            <p><strong><i class="fas fa-calendar-alt text-custom-blue"></i> Application Date:</strong> {{ $application->created_at->format('d M, Y') }}</p>

            @if($application->status == 'disputed')
            <form action="{{ route('admin.rental-applications.resolve', $application->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-emerald"><i class="fas fa-check"></i> Resolve Dispute</button>
            </form>
            @endif

            <a href="{{ route('admin.rental-applications.index') }}" class="btn btn-gray">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

<!-- Custom Styling -->
<style>
    .text-custom-blue {
        color: #2C3E50 !important; /* Royal Blue */
    }

    .text-gold {
        color: #F4A62A !important; /* Gold */
    }

    .badge {
        font-size: 0.9rem;
        padding: 6px 10px;
        border-radius: 6px;
        font-weight: bold;
    }

    .bg-emerald {
        background-color: #2ECC71 !important; /* Emerald Green */
        color: white;
    }

    .bg-orange {
        background-color: #E67E22 !important; /* Orange */
        color: white;
    }

    .bg-red {
        background-color: #C0392B !important; /* Red */
        color: white;
    }

    .bg-gray {
        background-color: #7F8C8D !important; /* Warm Gray */
        color: white;
    }

    .btn {
        border-radius: 6px;
        transition: all 0.3s ease-in-out;
        font-weight: bold;
        padding: 8px 12px;
        font-size: 14px;
    }

    .btn-emerald {
        background-color: #2ECC71; /* Emerald Green */
        color: white;
    }

    .btn-emerald:hover {
        background-color: #27AE60;
        transform: scale(1.05);
    }

    .btn-gray {
        background-color: #7F8C8D; /* Warm Gray */
        color: white;
    }

    .btn-gray:hover {
        background-color: #6C757D;
        transform: scale(1.05);
    }

    .card {
        background: white;
        border-radius: 12px;
        border: 2px solid #7F8C8D;
    }
</style>
@endsection
