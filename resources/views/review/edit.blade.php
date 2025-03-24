@extends('layouts.app')

@section('title', 'Edit Review')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <h3 class="mb-3 text-center">Edit Your Review</h3>
        
        <form action="{{ route('review.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Star Rating -->
            <div class="mb-3">
                <label for="rating" class="form-label">Rating:</label>
                <select name="rating" class="form-select">
                    <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (Excellent)</option>
                    <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (Good)</option>
                    <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>⭐⭐⭐ (Average)</option>
                    <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>⭐⭐ (Below Average)</option>
                    <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>⭐ (Poor)</option>
                </select>
            </div>

            <!-- Review Text -->
            <div class="mb-3">
                <label for="review" class="form-label">Your Review:</label>
                <textarea name="review" class="form-control" rows="4">{{ $review->review }}</textarea>
            </div>

            <!-- Submit & Cancel Buttons -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('properties.show', $review->property_id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Update Review
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
