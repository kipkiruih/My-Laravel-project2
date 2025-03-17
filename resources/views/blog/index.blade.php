@extends('layouts.app')

@section('content')
<style>
    .btn-custom {
        background-color: #7F8C8D; /* Warm Gray */
        color: white;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
        text-decoration: none;
    }
    .btn-custom:hover {
        background-color: #2C3E50; /* Dark Grayish Blue */
        color: white;
        transform: scale(1.05);
    }
</style>

<div class="container py-5">
    <div class="text-center" data-aos="fade-down">
        <h1 class="fw-bold text-dark">
            <i class="fas fa-blog text-warning"></i> Our Blog
        </h1>
        <p class="text-muted">Read the latest insights on real estate trends.</p>
    </div>

    <div class="row mt-4">
        @foreach($blogs as $blog)
            <div class="col-md-4" data-aos="fade-up">
                <div class="card shadow-sm border-0">
                    <!-- Blog Image -->
                    <img src="{{ asset('storage/blogs/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                    
                    <div class="card-body">
                        <!-- Blog Title -->
                        <h5 class="card-title text-dark">
                            <i class="fas fa-newspaper text-secondary"></i> {{ $blog->title }}
                        </h5>

                        <!-- Excerpt -->
                        <p class="card-text text-secondary">
                            <i class="fas fa-align-left"></i> {{ $blog->excerpt }}
                        </p>

                        <!-- Read More Button -->
                        <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-outline-dark btn-hover">
                            <i class="fas fa-book-open"></i> Read More
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $blogs->links() }}
    </div>

    <!-- Back to Home Button -->
    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-custom">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>
</div>
@endsection
