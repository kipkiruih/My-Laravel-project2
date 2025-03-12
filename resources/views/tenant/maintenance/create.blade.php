@extends('layouts.tenant')

@section('content')
<div class="container">
    <h2>New Maintenance Request</h2>
    <form action="{{ route('tenant.maintenance.store') }}" method="POST">
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
        
        
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit Request</button>
    </form>
</div>
@endsection
