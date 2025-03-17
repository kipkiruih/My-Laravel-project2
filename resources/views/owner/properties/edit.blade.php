@extends('layouts.owner')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <h3><i class="fas fa-edit"></i> Edit Property</h3>
        <hr>

        <form action="{{ route('owner.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Property Title -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-home"></i> Property Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $property->title) }}" required>
            </div>

            <!-- Property Location -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-map-marker-alt"></i> Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $property->location) }}" required>
            </div>

            <!-- Property Price -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-dollar-sign"></i> Price (Ksh)</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $property->price) }}" required>
            </div>

            <!-- Property Description -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-align-left"></i> Description</label>
                <textarea name="description" class="form-control" rows="4" required>{{ old('description', $property->description) }}</textarea>
            </div>

            <!-- Property Type -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-building"></i> Property Type</label>
                <select name="property_type" class="form-select" required>
                    <option value="Commercial" {{ $property->property_type == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                    <option value="Apartment" {{ $property->property_type == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="House" {{ $property->property_type == 'House' ? 'selected' : '' }}>House</option>
                    <option value="Land" {{ $property->property_type == 'Land' ? 'selected' : '' }}>Land</option>
                </select>
            </div>

            <!-- Property Status -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-info-circle"></i> Status</label>
                <select name="status" class="form-select" required>
                    <option value="Available" {{ $property->status == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Rented" {{ $property->status == 'Rented' ? 'selected' : '' }}>Rented</option>
                    <option value="Sold" {{ $property->status == 'Sold' ? 'selected' : '' }}>Sold</option>
                </select>
            </div>

            <!-- Property Image Preview -->
            @if($property->image)
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-image"></i> Current Image</label><br>
                <img src="{{ asset('storage/' . $property->image) }}" alt="Property Image" class="img-thumbnail" width="200">
            </div>
            @endif

            <!-- Property Image Upload -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-camera"></i> Change Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <!-- Submit & Cancel Buttons -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('owner.properties.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancel</a>
                <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Update Property</button>
            </div>
        </form>
    </div>
</div>
@endsection
