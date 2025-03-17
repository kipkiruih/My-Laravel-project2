@extends('layouts.tenant')

@section('content')
<style>/* General Styling */
    body {
        font-family: 'Poppins', sans-serif;
    }
    
    /* Card Styling */
    .card {
        border-radius: 12px;
        padding: 20px;
    }
    
    /* Status Badges */
    .badge {
        font-size: 14px;
        padding: 6px 12px;
        border-radius: 6px;
    }
    
    /* Custom Button */
    .custom-btn {
        background-color: #2C3E50;
        color: #fff;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease-in-out, transform 0.2s;
        display: inline-block;
        border: none;
    }
    
    .custom-btn:hover {
        background-color: #1B2838;
        transform: scale(1.05);
    }
    </style>
<div class="container mt-4">
    <h2 class="text-dark mb-4"><i class="fas fa-tools"></i> Maintenance Request Details</h2>

    <div class="card shadow-lg border-0 rounded">
        <div class="card-body">
            <h5 class="card-title fw-bold custom-subject">{{ $maintenanceRequest->subject }}</h5>
            <p class="card-text"><strong><i class="fas fa-building text-secondary"></i> Property:</strong> {{ $maintenanceRequest->property->title ?? 'N/A' }}</p>
            <p class="card-text"><strong><i class="fas fa-align-left text-secondary"></i> Description:</strong> {{ $maintenanceRequest->description }}</p>
            <p class="card-text">
                <strong><i class="fas fa-check-circle"></i> Status:</strong>
                <span class="badge bg-{{ $maintenanceRequest->status == 'Completed' ? 'success' : ($maintenanceRequest->status == 'In Progress' ? 'warning' : 'danger') }}">
                    {{ ucfirst($maintenanceRequest->status) }}
                </span>
            </p>
            <p class="card-text"><strong><i class="fas fa-clock text-secondary"></i> Created At:</strong> 
                {{ $maintenanceRequest->created_at ? $maintenanceRequest->created_at->format('d M Y, H:i A') : 'N/A' }}
            </p>
        </div>
    </div>

    <a href="{{ route('tenant.maintenance.index') }}" class="btn custom-btn mt-3">
        <i class="fas fa-arrow-left"></i> Back to Requests
    </a>
</div>
@endsection
