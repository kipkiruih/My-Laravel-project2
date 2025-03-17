@extends('layouts.app')

@section('content')
<style>
    .blog-content {
        font-size: 18px;
        line-height: 1.8;
        color: #333;
    }
    .blog-content h2, .blog-content h3 {
        color: #444; /* Neutral dark color */
        margin-top: 20px;
        font-weight: bold;
    }
    .blog-content ul {
        margin-left: 20px;
        list-style-type: disc;
    }
    .blog-content li {
        margin-bottom: 8px;
    }
    .blog-content p {
        margin-bottom: 15px;
    }
    .btn-custom {
        background-color: #7F8C8D; /* Warm Gray */
        color: white;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
        text-decoration: none;
        display: inline-block;
    }
    .btn-custom:hover {
        background-color: #2C3E50; /* Dark Grayish Blue */
        color: white;
        transform: scale(1.05);
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Blog Image -->
            <img src="{{ asset('storage/blogs/' . $blog->image) }}" class="img-fluid rounded mb-4" alt="{{ $blog->title }}">

            <!-- Blog Title -->
            <h1 class="fw-bold text-dark">
                <i class="fas fa-newspaper text-warning"></i> {{ $blog->title }}
            </h1>
            
            <!-- Date Published -->
            <p class="text-muted">
                <i class="fas fa-calendar-alt text-secondary"></i> Published on {{ $blog->created_at->format('F d, Y') }}
            </p>

            <!-- Blog Content -->
            <div class="blog-content text-dark">
                {!! $blog->content !!}
            </div>

            <!-- Back to Home Button -->
            <a href="{{ route('home') }}" class="btn btn-custom mt-4">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
