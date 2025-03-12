@extends('layouts.tenant')

@section('content')
<div class="container">
    <h2>Maintenance Request Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $maintenanceRequest->subject }}</h5>
            <p class="card-text"><strong>Property:</strong> {{ $maintenanceRequest->property->title ?? 'N/A' }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $maintenanceRequest->description }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($maintenanceRequest->status) }}</p>
            <p class="card-text"><strong>Created At:</strong> 
                {{ $maintenanceRequest->created_at ? $maintenanceRequest->created_at->format('d M Y H:i A') : 'N/A' }}
            </p>
                    </div>
    </div>

    <a href="{{ route('tenant.maintenance.index') }}" class="btn btn-primary mt-3">Back to Requests</a>
</div>
@endsection
