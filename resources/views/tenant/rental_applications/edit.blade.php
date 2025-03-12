@extends('layouts.tenant')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="col-md-8"> <!-- Reduced width -->
        <h2 class="text-dark mb-4">
            <i class="fas fa-edit text-warning"></i> Edit Rental Application
        </h2>

        <div class="card shadow border-0 rounded-4">
            <div class="card-header text-white" style="background-color: #2C3E50;">
                <h5 class="mb-0">
                    <i class="fas fa-file-alt"></i> Update Application Details
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tenant.rental_applications.update', $rentalApplication->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Property Selection -->
                    <div class="mb-3">
                        <label for="property_id" class="form-label fw-bold">
                            <i class="fas fa-home text-success"></i> Select Property
                        </label>
                        <select class="form-control border-2 rounded-pill px-3" name="property_id" required>
                            @foreach($properties as $property)
                            <option value="{{ $property->id }}" 
                                {{ $rentalApplication->property_id == $property->id ? 'selected' : '' }}>
                                {{ $property->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Message Field -->
                    <div class="mb-3">
                        <label for="message" class="form-label fw-bold">
                            <i class="fas fa-comment-alt text-warning"></i> Message (Optional)
                        </label>
                        <textarea class="form-control border-2 rounded-3 px-3" name="message" rows="4" placeholder="Enter a message...">{{ $rentalApplication->message }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn text-white w-100 py-2 rounded-pill shadow"
                        style="background-color: #2ECC71; transition: 0.3s;"
                        onmouseover="this.style.backgroundColor='#27AE60'"
                        onmouseout="this.style.backgroundColor='#2ECC71'">
                        <i class="fas fa-save"></i> Update Application
                    </button>

                    <!-- Cancel Button -->
                    <a href="{{ route('tenant.rental_applications.index') }}" 
                       class="btn text-white w-100 mt-2 py-2 rounded-pill shadow"
                       style="background-color: #7F8C8D; transition: 0.3s;"
                       onmouseover="this.style.backgroundColor='#5E6E70'"
                       onmouseout="this.style.backgroundColor='#7F8C8D'">
                        <i class="fas fa-times"></i> Cancel
                    </a>

                    <!-- Back Button -->
                    <div class="text-center mt-3">
                        <a href="{{ route('tenant.rental_applications.index') }}" 
                           class="btn text-white px-4 py-2 rounded-pill shadow-lg"
                           style="background-color: #F4A62A; transition: background-color 0.3s, transform 0.2s;"
                           onmouseover="this.style.backgroundColor='#D48C21'; this.style.transform='scale(1.05)';"
                           onmouseout="this.style.backgroundColor='#F4A62A'; this.style.transform='scale(1)';">
                            <i class="fas fa-arrow-left"></i> Back to Applications
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
