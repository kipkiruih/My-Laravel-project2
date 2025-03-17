@extends('layouts.owner')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <h3 class="text-dark"><i class="fas fa-plus"></i> Add New Property</h3>
        <hr>

        <form action="{{ route('owner.properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Property Title -->
                <div class="mb-3 col-md-6">
                    <label class="form-label text-dark"><i class="fas fa-home"></i> Property Title</label>
                    <input type="text" name="title" class="form-control border-secondary" placeholder="Enter property title" value="{{ old('title') }}" required>
                </div>

                <!-- Property Location -->
                <div class="mb-3 col-md-6">
                    <label class="form-label text-dark"><i class="fas fa-map-marker-alt"></i> Location</label>
                    <input type="text" name="location" class="form-control border-secondary" placeholder="Enter property location" value="{{ old('location') }}" required>
                </div>
            </div>

            <!-- Property Description -->
            <div class="mb-3">
                <label class="form-label text-dark"><i class="fas fa-align-left"></i> Description</label>
                <textarea name="description" class="form-control border-secondary" rows="4" placeholder="Enter property description" required>{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <!-- Property Price -->
                <div class="mb-3 col-md-6">
                    <label class="form-label text-dark"><i class="fas fa-dollar-sign"></i> Price (Ksh)</label>
                    <input type="number" name="price" class="form-control border-secondary" placeholder="Enter property price" value="{{ old('price') }}" required>
                </div>

                <!-- Property Type -->
                <div class="mb-3 col-md-6">
                    <label class="form-label text-dark"><i class="fas fa-building"></i> Property Type</label>
                    <select name="property_type" class="form-select border-secondary" required>
                        <option value="Commercial">Commercial</option>
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                        <option value="Land">Land</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <!-- Property Status -->
                <div class="mb-3 col-md-6">
                    <label class="form-label text-dark"><i class="fas fa-info-circle"></i> Status</label>
                    <select name="status" class="form-select border-secondary" required>
                        <option value="Available">Available</option>
                        <option value="Rented">Rented</option>
                        <option value="Sold">Sold</option>
                    </select>
                </div>

                <!-- Property Image -->
                <div class="mb-3 col-md-6">
                    <label class="form-label text-dark"><i class="fas fa-image"></i> Property Image</label>
                    <input type="file" name="image" class="form-control border-secondary" accept="image/*" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Save Property</button>
                <a href="{{ route('owner.properties.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
