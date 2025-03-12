@extends('layouts.owner')

@section('content')
<div class="container">
    <h2>Maintenance Request Details</h2>

    <p><strong>Property:</strong> {{ $maintenanceRequest->property->title ?? 'N/A' }}</p>
    <p><strong>Subject:</strong> {{ $maintenanceRequest->subject }}</p>
    <p><strong>Description:</strong> {{ $maintenanceRequest->description }}</p>
    <p><strong>Status:</strong> {{ ucfirst($maintenanceRequest->status) }}</p>
    <p><strong>Requested On:</strong> {{ $maintenanceRequest->created_at->format('d M Y H:i A') }}</p>

    <!-- Status Update Form -->
    <form action="{{ route('owner.maintenance.update', $maintenanceRequest->id) }}" method="POST">
        @csrf
        @method('PUT')  <!-- Ensures it's a PUT request -->
        <div class="mb-3">
            <label for="status" class="form-label">Update Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $maintenanceRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $maintenanceRequest->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $maintenanceRequest->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>

    <a href="{{ route('owner.maintenance.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
