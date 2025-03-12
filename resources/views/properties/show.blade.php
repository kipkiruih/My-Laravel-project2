@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="row">
        <!-- Property Image -->
        <div class="col-md-6">
            <img src="{{ $property->image ? asset('storage/' . $property->image) : asset('images/default.jpg') }}" 
                 class="img-fluid rounded shadow">
        </div>

        <!-- Property Details -->
        <div class="col-md-6">
            <h2>{{ $property->title }}</h2>
            <p class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $property->location }}</p>
            <p class="text-success">Ksh {{ number_format($property->price, 2) }}</p>
            <p>{{ $property->description }}</p>

            <!-- Contact Owner Button -->
            <a href="{{ optional($property->owner)->phone ? 'tel:' . $property->owner->phone : '#' }}" 
               class="btn btn-success {{ $property->owner ? '' : 'disabled' }}">
                <i class="fas fa-phone"></i> Contact Owner
            </a>

            <!-- Bookmark Button -->
            <form action="{{ route('tenant.bookmarks.store') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-bookmark"></i> {{ $isBookmarked ? 'Remove Bookmark' : 'Bookmark' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Rating Form -->
    <h4 class="text-primary mt-4"><i class="fas fa-star"></i> Rate this Property</h4>
    <form action="{{ route('tenant.ratings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="property_id" value="{{ $property->id }}">
        <div class="form-group">
            <label>Rating (1-5):</label>
            <select name="rating" class="form-control">
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} Star(s)</option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label>Review:</label>
            <textarea name="review" class="form-control" rows="3"></textarea>
        </div>
        <button class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
    </form>

    <!-- Display Reviews -->
    <h4 class="text-primary mt-4"><i class="fas fa-comments"></i> Reviews</h4>

    @if(optional($property->reviews)->count() > 0)
    @foreach($property->reviews as $review)
            <div class="border p-2 mb-2">
                <strong class="text-dark">{{ optional($review->tenant)->name }}</strong>
                <span class="text-warning">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                    @endfor
                </span>
                <p class="text-muted">{{ $review->review }}</p>
    
                @if(auth()->id() == $review->tenant_id)
                    <form action="{{ route('tenant.reviews.update', $review->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="text" name="review" class="form-control" value="{{ $review->review }}">
                        <button class="btn btn-outline-primary mt-2"><i class="fas fa-edit"></i> Edit</button>
                    </form>
                    <form action="{{ route('tenant.reviews.destroy', $review->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger mt-2"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                @endif
    
                <!-- Review Replies -->
                <h6 class="text-primary"><i class="fas fa-reply"></i> Replies</h6>
                @foreach($review->replies as $reply)
                    <p><strong>{{ optional($reply->user)->name }}</strong>: {{ $reply->reply }}</p>
                @endforeach
    
                <!-- Reply Form -->
                <form action="{{ route('owner.review-replies.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                    <input type="text" name="reply" class="form-control" placeholder="Reply to this review">
                    <button class="btn btn-success mt-2"><i class="fas fa-paper-plane"></i> Reply</button>
                </form>
            </div>
        @endforeach
    @else
        <p class="text-muted">No reviews yet. Be the first to review this property!</p>
    @endif

@endsection
