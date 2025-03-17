@extends('layouts.tenant')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark mb-4">
        <i class="fas fa-info-circle" style="color: #2C3E50;"></i> Application Details
    </h2>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <h4 class="fw-bold" style="color: #2C3E50;">
                <i class="fas fa-home"></i> {{ $rentalApplication->property->title }}
            </h4>
            <hr>

            <!-- Status -->
            <p class="mb-3">
                <strong><i class="fas fa-clipboard-check"></i> Status:</strong> 
                <span class="badge px-3 py-2 text-white fw-bold"
                    @if($rentalApplication->status == 'Pending') 
                        style="background-color: #7F8C8D;" <!-- Warm Gray -->
                    @elseif($rentalApplication->status == 'Approved') 
                        style="background-color: #2C3E50;" <!-- Royal Blue -->
                    @else 
                        style="background-color: #E74C3C;" <!-- Red -->
                    @endif>
                    {{ $rentalApplication->status }}
                </span>
            </p>

            <!-- Message -->
            <p class="fw-bold"><i class="fas fa-comment-alt"></i> Message:</p>
            <div class="p-3 border rounded-3 bg-light text-dark shadow-sm">
                {{ $rentalApplication->message ?? 'No message provided.' }}
            </div>

            <div class="mt-4">
                <a href="{{ route('tenant.rental_applications.index') }}" 
                   class="btn text-white px-4 py-2 rounded-pill shadow-lg fw-bold"
                   style="background-color: #2C3E50; transition: background-color 0.3s, transform 0.2s;"
                   onmouseover="this.style.backgroundColor='#1F2A36'; this.style.transform='scale(1.05)';"
                   onmouseout="this.style.backgroundColor='#2C3E50'; this.style.transform='scale(1)';">
                    <i class="fas fa-arrow-left"></i> Back to Applications
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
