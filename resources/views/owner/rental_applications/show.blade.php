@extends('layouts.owner')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold" style="color: #2C3E50;">
        <i class="fas fa-file-alt"></i> Rental Application Details
    </h2> <!-- Neutral Dark Gray -->

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong><i class="fas fa-user"></i> Tenant:</strong> {{ $rentalApplication->tenant->name }}</p>
            <p><strong><i class="fas fa-home"></i> Property:</strong> {{ $rentalApplication->property->title }}</p>
            <p><strong><i class="fas fa-info-circle"></i> Status:</strong> 
                <span class="badge 
                    @if($rentalApplication->status == 'Pending') bg-warning
                    @elseif($rentalApplication->status == 'Approved') bg-success
                    @else bg-danger @endif">
                    {{ $rentalApplication->status }}
                </span>
            </p>
            <p><strong><i class="fas fa-comment"></i> Message:</strong> {{ $rentalApplication->message ?? 'N/A' }}</p>

            @if($rentalApplication->status == 'Pending')
            <form action="{{ route('owner.rental_applications.update', $rentalApplication->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="status" class="form-label fw-bold">
                        <i class="fas fa-check-circle"></i> Select Status
                    </label>
                    <select class="form-select border-secondary" name="status" required>
                        <option value="Approved">Approve</option>
                        <option value="Rejected">Reject</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label fw-bold">
                        <i class="fas fa-envelope"></i> Message (optional)
                    </label>
                    <textarea class="form-control border-secondary" name="message" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success custom-btn">
                    <i class="fas fa-check"></i> Approve/Reject
                </button>
            </form>
            @endif

            <a href="{{ route('owner.rental_applications.index') }}" class="btn btn-dark custom-btn mt-3">
                <i class="fas fa-arrow-left"></i> Back to Applications
            </a>
        </div>
    </div>
</div>

<!-- Custom Styles for Hover Effects -->
<style>
    .custom-btn {
        transition: all 0.3s ease-in-out;
    }

    .custom-btn:hover {
        transform: scale(1.05); /* Slight zoom effect */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .btn-success:hover {
        background-color: #218838 !important; /* Darker green */
    }

    .btn-dark:hover {
        background-color: #1a252f !important; /* Slightly darker shade of black */
    }
</style>
@endsection
