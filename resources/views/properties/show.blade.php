@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



<style>
    /* General Styles */
    .heading-style {
        color: #2C3E50;
        font-weight: bold;
    }

    /* Buttons */
    .contact-owner-btn, .bookmark-btn, .submit-btn {
        padding: 10px 15px;
        border-radius: 8px;
        transition: 0.3s ease-in-out;
    }
    .contact-owner-btn { background-color: #2C3E50; color: white; }
    .contact-owner-btn:hover { background-color: #1a252f; }

    .bookmark-btn { background-color: #F4A62A; color: white; }
    .bookmark-btn:hover { background-color: #d48b1e; }

    .submit-btn { background-color: #2C3E50; color: white; }
    .submit-btn:hover { background-color: #1a252f; }

    /* Form */
    .review-form-container {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: auto;
    }
    .form-input {
        border: 1px solid #7F8C8D;
        color: #2C3E50;
        padding: 10px;
        border-radius: 5px;
    }
    .form-input:focus {
        border-color: #F4A62A;
        box-shadow: 0 0 5px rgba(244, 166, 42, 0.5);
    }

    /* Review Section */
    .review-card {
        background: #fff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }
    .reviewer-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #F4A62A;
    }
    .review-content {
        flex-grow: 1;
    }
    .reviewer-name {
        font-weight: bold;
        color: #2C3E50;
    }
    .review-text {
        color: #333;
    }

    /* Back to Properties Button */
/* Back to Properties Button */
.back-to-properties-btn {
    background-color: #2C3E50; /* Royal Blue */
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s ease-in-out;
    display: inline-block;
    margin-bottom: 20px;
    font-weight: bold;
}
.back-to-properties-btn:hover {
    background-color: #F4A62A; /* Gold */
    color: #2C3E50; /* Text color changes for contrast */
}

</style>

<div class="container mt-4">
    <a href="{{ route('properties.index') }}" class="btn back-to-properties-btn">
        <i class="fas fa-arrow-left"></i> Back to Properties
    </a>
</div>

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
            <p class="mb-2">
                <strong>Average Rating:</strong> {{ number_format($property->averageRating(), 1) }} ⭐
            </p>
            
            <p class="text-muted"><i class="fas fa-map-marker-alt text-danger"></i> {{ $property->location }}</p>
            <p class="fw-bold text-dark">Ksh {{ number_format($property->price, 2) }}</p>
            <p class="text-secondary">{{ $property->description }}</p>
      

            <div class="owner-info mt-4">
                <h4 class="heading-style"><i class="fas fa-user"></i> Property Owner Details</h4>
                <div class="d-flex align-items-center">
                    <img src="{{ optional($property->owner)->profile_image ? asset('storage/' . $property->owner->profile_image) : asset('images/default-user.png') }}" 
                         alt="Owner Profile" class="reviewer-img">
                    <div class="ms-3">
                        <p class="mb-1"><strong>Name:</strong> {{ optional($property->owner)->name ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Verification:</strong> 
                            {!! optional($property->owner)->status ? '<span class="badge bg-success">Verified</span>' : '<span class="badge bg-danger">Not Verified</span>' !!}
                        </p>
                    </div>
                </div>
            </div>

            <a href="{{ optional($property->owner)->phone ? 'https://wa.me/' . str_replace('+', '', $property->owner->phone) . '?text=Hello,%20I%20am%20interested%20in%20your%20property%20(' . urlencode($property->title) . ').%20Is%20it%20still%20available?' : '#' }}" 
                class="btn text-white contact-owner-btn {{ $property->owner ? '' : 'disabled' }}" 
                target="_blank">
                 <i class="fab fa-whatsapp"></i> Whatsapp Me
             </a>
            <h4 class="mt-4 heading-style"><i class="fas fa-envelope"></i> Contact Property Owner</h4>
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(auth()->check())
                <div class="review-form-container">
                    <form action="{{ route('property.contact', $property->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name:</label>
                            <input type="text" name="name" class="form-control form-input" required value="{{ auth()->user()->name }}">
                        </div>
            
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email:</label>
                            <input type="email" name="email" class="form-control form-input" required value="{{ auth()->user()->email }}">
                        </div>
            
                        <div class="mb-3">
                            <label for="phone" class="form-label">Your Phone:</label>
                            <input type="text" name="phone" class="form-control form-input" required>
                        </div>
            
                        <div class="mb-3">
                            <label for="message" class="form-label">Message:</label>
                            <textarea name="message" rows="4" class="form-control form-input" required placeholder="Enter your message..."></textarea>
                        </div>
            
                        <button type="submit" class="btn submit-btn w-100"><i class="fas fa-paper-plane"></i> Send Message</button>
                    </form>
                </div>
            @else
                <p class="text-danger"><i class="fas fa-info-circle"></i> Please <a href="{{ route('login') }}">log in</a> to contact the owner.</p>
            @endif
                        
            
        </div>
    </div>

    <!-- Rating Form -->
    <h4 class="mt-4 heading-style text-center"><i class="fas fa-star text-warning"></i> Rate this Property</h4>
    @if(auth()->check())
        <div class="review-form-container">
            <form action="{{ url('/properties/'.$property->id.'/review') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating:</label>
                    <select name="rating" required class="form-select rating-dropdown">
                        <option value="5">⭐⭐⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                        <option value="2">⭐⭐</option>
                        <option value="1">⭐</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="review" class="form-label">Review:</label>
                    <textarea name="review" rows="3" class="form-control form-input" placeholder="Write your review (optional)"></textarea>
                </div>

                <button type="submit" class="btn submit-btn w-100"><i class="fas fa-paper-plane"></i> Submit Review</button>
            </form>
        </div>
    @endif

    <!-- Reviews Section -->
<h3 class="mt-4 heading-style">Reviews ({{ $property->reviews->count() }})</h3>
@foreach($property->reviews as $review)
    <div class="review-card mb-3">
        <img src="{{ $review->user->profile_image ? asset('storage/' . $review->user->profile_image) : asset('images/default-user.png') }}" 
             alt="Profile Image" class="reviewer-img">
        <div class="review-content">
            <p class="reviewer-name"><i class="fas fa-user-circle"></i> {{ $review->user->name }}</p>
            <p class="mb-1"><strong>Rated:</strong> {{ $review->rating }} ⭐</p>
            <p class="review-text">{{ $review->review }}</p>

            <!-- Show Edit Button Only for Review Owner -->
            @if(auth()->check() && auth()->id() === $review->user_id)
                <a href="{{ route('review.edit', $review->id) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            @endif
        </div>
    </div>
@endforeach

</div>

<script>
    // Auto-hide the alert after 3 seconds
    setTimeout(function() {
        $(".alert").fadeOut("slow");
    }, 3000);

    // Ensure manual close button works
    $(document).on("click", ".btn-close", function() {
        $(this).closest(".alert").fadeOut("slow");
    });
</script>


@endsection
