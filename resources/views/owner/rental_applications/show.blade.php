@extends('layouts.owner')

@section('content')
<div class="container mt-4">
    <h2 class="text-primary">Rental Application Details</h2>
    
    <div class="card">
        <div class="card-body">
            <p><strong>Tenant:</strong> {{ $rentalApplication->tenant->name }}</p>
            <p><strong>Property:</strong> {{ $rentalApplication->property->title }}</p>
            <p><strong>Status:</strong> 
                <span class="badge 
                    @if($rentalApplication->status == 'Pending') bg-warning
                    @elseif($rentalApplication->status == 'Approved') bg-success
                    @else bg-danger @endif">
                    {{ $rentalApplication->status }}
                </span>
            </p>
            <p><strong>Message:</strong> {{ $rentalApplication->message ?? 'N/A' }}</p>

            @if($rentalApplication->status == 'Pending')
            <form action="{{ route('owner.rental_applications.update', $rentalApplication->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="status" class="form-label">Select Status</label>
                    <select class="form-control" name="status" required>
                        <option value="Approved">Approve</option>
                        <option value="Rejected">Reject</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message (optional)</label>
                    <textarea class="form-control" name="message" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i> Approve/Reject
                </button>
            </form>
            @endif

            <a href="{{ route('owner.rental_applications.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Back to Applications
            </a>
        </div>
    </div>
</div>
@endsection
