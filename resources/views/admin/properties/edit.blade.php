@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="border-radius: 12px; max-width: 600px; width: 100%;">
        <h2 class="mb-4 text-center" style="color: #2C3E50;">
            <i class="fas fa-edit"></i> Edit Property
        </h2>

        <form action="{{ route('admin.properties.update', $property->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-3">
                <label class="form-label" style="color: #2C3E50;"><i class="fas fa-home"></i> Title</label>
                <input type="text" name="title" class="form-control" value="{{ $property->title }}" required>
            </div>

            <!-- Property Type -->
            <div class="mb-3">
                <label class="form-label" style="color: #2C3E50;"><i class="fas fa-layer-group"></i> Property Type</label>
                <select name="property_type" class="form-control">
                    <option value="apartment" {{ $property->property_type == 'apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="house" {{ $property->property_type == 'house' ? 'selected' : '' }}>House</option>
                    <option value="commercial" {{ $property->property_type == 'commercial' ? 'selected' : '' }}>Commercial</option>
                    <option value="land" {{ $property->property_type == 'land' ? 'selected' : '' }}>Land</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label" style="color: #2C3E50;"><i class="fas fa-file-alt"></i> Description</label>
                <textarea name="description" class="form-control" rows="3" id="description" oninput="updateCharCount()">{{ $property->description }}</textarea>
                <small id="charCount" class="text-muted">0/500 characters</small>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.properties.index') }}" class="btn btn-gray"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Character Counter -->
<script>
    function updateCharCount() {
        let text = document.getElementById('description').value;
        document.getElementById('charCount').innerText = text.length + "/500 characters";
    }
    updateCharCount();
</script>

<!-- Custom Styling -->
<style>
    .form-control {
        border-radius: 8px;
        padding-left: 10px;
        border: 2px solid #7F8C8D;
    }

    .btn {
        border-radius: 6px;
        transition: all 0.3s ease-in-out;
        font-weight: bold;
    }

    .btn-gold {
        background-color: #F4A62A;
        color: #FFFFFF;
    }

    .btn-gold:hover {
        background-color: #D98E1F;
        transform: scale(1.05);
    }

    .btn-gray {
        background-color: #7F8C8D;
        color: #FFFFFF;
    }

    .btn-gray:hover {
        background-color: #6C757D;
        transform: scale(1.05);
    }

    .card {
        border: 2px solid #7F8C8D;
    }
</style>
@endsection
