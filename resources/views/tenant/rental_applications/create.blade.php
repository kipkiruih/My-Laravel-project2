@extends('layouts.tenant')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="col-md-8"> <!-- Reduced width -->
        <h2 class="text-dark mb-4">
            <i class="fas fa-home text-success"></i> Apply for Rental
        </h2>

        <div class="card shadow border-0 rounded-4">
            <div class="card-header text-white" style="background-color: #2C3E50;">
                <h5 class="mb-0">
                    <i class="fas fa-file-alt"></i> Rental Application Form
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tenant.rental_applications.store') }}" method="POST">
                    @csrf

                    <!-- Property Selection -->
                    <div class="mb-3">
                        <label for="property_id" class="form-label fw-bold">
                            <i class="fas fa-building text-warning"></i> Select Property
                        </label>
                        <select class="form-control border-2 rounded-pill px-3" name="property_id" required>
                            <option value="" disabled selected>-- Choose a Property --</option>
                            @foreach($properties as $property)
                            <option value="{{ $property->id }}">{{ $property->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Message Field -->
                    <div class="mb-3">
                        <label for="message" class="form-label fw-bold">
                            <i class="fas fa-comment-alt text-success"></i> Additional Message (Optional)
                        </label>
                        <textarea class="form-control border-2 rounded-3 px-3" name="message" rows="4" placeholder="Write a message..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn text-white w-100 py-2 rounded-pill shadow"
                        style="background-color: #F4A62A; transition: 0.3s;"
                        onmouseover="this.style.backgroundColor='#D48C21'"
                        onmouseout="this.style.backgroundColor='#F4A62A'">
                        <i class="fas fa-paper-plane"></i> Submit Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
