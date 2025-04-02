@extends('layouts.owner')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header" style="background-color: #2C3E50; color: white;">
            <h4 class="mb-0"><i class="fas fa-tools"></i> Maintenance Request Details</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Property Image -->
                <div class="col-md-4">
                    <img src="{{ asset('storage/'.$maintenanceRequest->property->image) }}" class="img-fluid rounded" alt="Property Image">
                </div>

                <!-- Request Details -->
                <div class="col-md-8">
                    <p><strong>Property:</strong> {{ $maintenanceRequest->property->title ?? 'N/A' }}</p>
                    <p><strong>Subject:</strong> {{ $maintenanceRequest->subject }}</p>
                    <p><strong>Description:</strong> {{ $maintenanceRequest->description }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge 
                            @if($maintenanceRequest->status == 'pending') bg-warning 
                            @elseif($maintenanceRequest->status == 'in_progress') bg-info 
                            @else bg-success 
                            @endif">
                            {{ ucfirst($maintenanceRequest->status) }}
                        </span>
                    </p>
                    <p><strong>Requested On:</strong> {{ $maintenanceRequest->created_at->format('d M Y, H:i A') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Update Form -->
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="mb-3"><i class="fas fa-edit"></i> Update Request Status</h5>
            <form action="{{ route('owner.maintenance.update', $maintenanceRequest->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="status" class="form-label">Select New Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" {{ $maintenanceRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $maintenanceRequest->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $maintenanceRequest->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn" style="background-color: #F4A62A; color: white;"><i class="fas fa-check-circle"></i> Update Status</button>
            </form>
        </div>
    </div>

    <a href="{{ route('owner.maintenance.index') }}" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>
@endsection
