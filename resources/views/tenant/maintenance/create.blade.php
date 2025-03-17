@extends('layouts.tenant')

@section('content')

<style>
    /* General Styling */
body {
    font-family: 'Poppins', sans-serif;
}

/* Card Styling */
.card {
    border-radius: 12px;
    padding: 20px;
}

/* Custom Input Fields */
.custom-input, .custom-textarea, .custom-select {
    border: 2px solid #7F8C8D;
    border-radius: 8px;
    padding: 10px;
    width: 100%;
    outline: none;
    transition: all 0.3s ease-in-out;
}

/* Remove Blue Border on Focus */
.custom-input:focus, .custom-textarea:focus, .custom-select:focus {
    border-color: #2C3E50 !important;
    box-shadow: none !important;
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
    <h2 class="text-dark mb-4"><i class="fas fa-tools"></i> New Maintenance Request</h2>

    <div class="card shadow-lg border-0 p-4">
        <form action="{{ route('tenant.maintenance.store') }}" method="POST">
            @csrf

            <!-- Property Selection -->
            <div class="mb-3">
                <label for="property_id" class="form-label fw-bold">
                    <i class="fas fa-building text-secondary"></i> Select Property
                </label>
                <select class="form-control custom-select" name="property_id" required>
                    <option value="" disabled selected>-- Choose a Property --</option>
                    @foreach($properties as $property)
                    <option value="{{ $property->id }}">{{ $property->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Subject -->
            <div class="mb-3">
                <label for="subject" class="form-label fw-bold">Subject</label>
                <input type="text" name="subject" class="form-control custom-input" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control custom-textarea" required></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn custom-btn">
                <i class="fas fa-paper-plane"></i> Submit Request
            </button>
        </form>
    </div>
</div>
@endsection
