@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Application Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Property: {{ $application->property?->title ?? 'N/A' }}</h5>
    
            <p class="card-text"><strong>Tenant:</strong> {{ $application->tenant?->name ?? 'N/A' }}</p>
    
            <p class="card-text"><strong>Owner:</strong> {{ $application->property?->owner?->name ?? 'N/A' }}</p> <!-- Owner accessed via property -->
    
            <p class="card-text"><strong>Status:</strong>
                <span class="badge bg-{{ 
                    $application->status == 'approved' ? 'success' : 
                    ($application->status == 'rejected' ? 'danger' : 
                    ($application->status == 'pending' ? 'warning' : 'info')) 
                }}">
                    {{ ucfirst($application->status) }}
                </span>
            </p>

            <p><strong>Application Date:</strong> {{ $application->created_at->format('d M, Y') }}</p>

            @if($application->status == 'disputed')
            <form action="{{ route('admin.rental-applications.resolve', $application->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Resolve Dispute</button>
            </form>
            @endif

            <a href="{{ route('admin.rental-applications.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>
@endsection
