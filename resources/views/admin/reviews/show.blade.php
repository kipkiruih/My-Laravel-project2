@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="fas fa-comment"></i> Review Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-home"></i> Property: {{ $review->property->title }}</h5>
            <p><strong><i class="fas fa-user"></i> Tenant:</strong> {{ $review->tenant->name }}</p>
            <p><strong><i class="fas fa-user-tie"></i> Owner:</strong> {{ $review->owner->name }}</p>
            <p><strong><i class="fas fa-star text-warning"></i> Rating:</strong> {{ $review->rating }} / 5</p>
            <p><strong><i class="fas fa-comment-dots"></i> Review:</strong> {{ $review->content }}</p>
            <p><strong><i class="fas fa-calendar"></i> Posted on:</strong> {{ $review->created_at->format('d M, Y') }}</p>

            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Remove Review
                </button>
            </form>

            <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>
@endsection
