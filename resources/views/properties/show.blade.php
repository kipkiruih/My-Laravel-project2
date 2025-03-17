@extends('layouts.app')

@section('content')
<style>
    /* General Styles */
.heading-style {
    color: #2C3E50;
    font-weight: bold;
}

/* Buttons */
.contact-owner-btn {
    background-color: #2C3E50;
    transition: 0.3s;
}
.contact-owner-btn:hover {
    background-color: #1a252f;
}

.bookmark-btn {
    background-color: #F4A62A;
    color: white;
    transition: 0.3s;
}
.bookmark-btn:hover {
    background-color: #d48b1e;
}

.submit-btn, .edit-btn {
    background-color: #2C3E50;
    color: white;
    transition: 0.3s;
}
.submit-btn:hover, .edit-btn:hover {
    background-color: #1a252f;
}

.delete-btn {
    background-color: #dc3545;
    color: white;
    transition: 0.3s;
}
.delete-btn:hover {
    background-color: #b52b38;
}

/* Form Inputs */
.form-input {
    border: 1px solid #7F8C8D;
    color: #2C3E50;
}
.form-input:focus {
    border-color: #F4A62A;
    box-shadow: 0 0 5px rgba(244, 166, 42, 0.5);
}
/* Fix for star selection (remove blue on select) */
.rating-dropdown option:checked,
.rating-dropdown option:hover {
    background-color: #F4A62A !important; /* Gold */
    color: white !important;
}

/* Star Rating Display */
.text-warning {
    color: #F4A62A !important; /* Gold for selected stars */
}
.text-muted {
    color: #7F8C8D !important; /* Warm Gray for unselected stars */
}

/* Hover effect for rating dropdown */
.rating-dropdown {
    border: 1px solid #7F8C8D;
    color: #2C3E50;
    background-color: white;
    transition: 0.3s;
}
.rating-dropdown:focus {
    border-color: #F4A62A;
    box-shadow: 0 0 5px rgba(244, 166, 42, 0.5);
}


</style>

<div class="container mt-4">
    <div class="row">
        <!-- Property Image -->
        <div class="col-md-6">
            <img src="{{ $property->image ? asset('storage/' . $property->image) : asset('images/default.jpg') }}" 
                 class="img-fluid rounded shadow">
        </div>

        <!-- Property Details -->
        <div class="col-md-6">
            <h2 class="text-dark">{{ $property->title }}</h2>
            <p class="text-muted"><i class="fas fa-map-marker-alt text-danger"></i> {{ $property->location }}</p>
            <p class="fw-bold text-dark">Ksh {{ number_format($property->price, 2) }}</p>
            <p class="text-secondary">{{ $property->description }}</p>

            <!-- Contact Owner Button -->
            <a href="{{ optional($property->owner)->phone ? 'tel:' . $property->owner->phone : '#' }}" 
               class="btn text-white contact-owner-btn {{ $property->owner ? '' : 'disabled' }}">
                <i class="fas fa-phone"></i> Contact Owner
            </a>

            <!-- Bookmark Button -->
            <form action="{{ route('tenant.bookmarks.store') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                <button type="submit" class="btn bookmark-btn">
                    <i class="fas fa-bookmark"></i> {{ $isBookmarked ? 'Remove Bookmark' : 'Bookmark' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Rating Form -->
<h4 class="mt-4 heading-style"><i class="fas fa-star text-warning"></i> Rate this Property</h4>
<form action="{{ route('tenant.ratings.store') }}" method="POST">
    @csrf
    <input type="hidden" name="property_id" value="{{ $property->id }}">
    
    <div class="form-group">
        <label>Rating (1-5):</label>
        <select name="rating" class="form-control rating-dropdown">
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }} Star(s)</option>
            @endfor
        </select>
    </div>

    <div class="form-group">
        <label>Review:</label>
        <textarea name="review" class="form-control form-input" rows="3"></textarea>
    </div>
    
    <button class="btn submit-btn"><i class="fas fa-check"></i> Submit</button>
</form>


    <!-- Display Reviews -->
    <h4 class="mt-4 heading-style"><i class="fas fa-comments"></i> Reviews</h4>

    @if(optional($property->reviews)->count() > 0)
        @foreach($property->reviews as $review)
            <div class="border p-3 mb-3 rounded shadow-sm">
                <strong class="text-dark">{{ optional($review->tenant)->name }}</strong>
                <span class="text-warning">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                    @endfor
                </span>
                <p class="text-muted">{{ $review->review }}</p>

                @if(auth()->id() == $review->tenant_id)
                    <form action="{{ route('tenant.reviews.update', $review->id) }}" method="POST" class="d-inline">
                        @csrf @method('PATCH')
                        <input type="text" name="review" class="form-control form-input" value="{{ $review->review }}">
                        <button class="btn edit-btn"><i class="fas fa-edit"></i> Edit</button>
                    </form>
                    <form action="{{ route('tenant.reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn delete-btn"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                @endif

                <!-- Review Replies -->
                <h6 class="mt-2 heading-style"><i class="fas fa-reply"></i> Replies</h6>
                @foreach($review->replies as $reply)
                    <p><strong>{{ optional($reply->user)->name }}</strong>: {{ $reply->reply }}</p>
                @endforeach

                <!-- Reply Form -->
                <form action="{{ route('owner.review-replies.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                    <input type="text" name="reply" class="form-control form-input" placeholder="Reply to this review">
                    <button class="btn submit-btn"><i class="fas fa-paper-plane"></i> Reply</button>
                </form>
            </div>
        @endforeach
    @else
        <p class="text-muted">No reviews yet. Be the first to review this property!</p>
    @endif

</div>

@endsection
