@extends('layouts.app')

@section('content')
<style>
    .cta-section {
    position: relative;
    background-size: cover;
    background-position: center;
    color: white;
    padding: 80px 0;
}

.cta-section h2 {
    font-size: 2.5rem;
}

.cta-section p {
    font-size: 1.2rem;
}

.btn-warning {
    background-color: #F4A62A;
    border: none;
    transition: all 0.3s ease-in-out;
}

.btn-warning:hover {
    background-color: #d98a1c;
    transform: scale(1.05);

    .hero-section {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: left;
}

.hero-section h1 {
    font-size: 2.8rem;
}

.hero-section p {
    font-size: 1.2rem;
}

.hero-section .btn-warning {
    background-color: #F4A62A;
    border: none;
    transition: all 0.3s ease-in-out;
}

.hero-section .btn-warning:hover {
    background-color: #d98a1c;
    transform: scale(1.05);
}

.features-section i {
    transition: transform 0.3s;
}

.features-section i:hover {
    transform: scale(1.2);
    color: #2ECC71 !important;
}


.property-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 5px;
}


    </style>
<div class="container">
    <!-- Hero Section -->
    <section class="hero-section position-relative py-5 text-white" style="background: linear-gradient(rgba(44, 62, 80, 0.7), rgba(44, 62, 80, 0.9)), url('{{ asset('images/hero-bg.jpg') }}') center/cover; min-height: 80vh;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <h1 class="fw-bold text-warning display-4 mb-3">Find Your Dream Home with <span class="text-white">Bingwa Homes</span></h1>
                <p class="lead text-light">Explore the best properties in Kenya, from apartments to commercial buildings. Your perfect home is just a click away.</p>
                <a href="{{ route('properties.index') }}" class="btn btn-lg btn-warning fw-bold px-4 shadow-sm" data-aos="zoom-in" data-aos-delay="100">
                    <i class="fa-solid fa-building"></i> Browse Properties
                </a>
            </div>
            <div class="col-md-6 text-center" data-aos="fade-left">
                <img src="{{ asset('images/dream_home') }}" alt="Dream Home" class="img-fluid rounded shadow-lg" style="max-width: 90%; transition: transform 0.3s;">
            </div>
        </div>
    </div>
</section>
<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4" data-aos="fade-up">
                <i class="fa-solid fa-map-location-dot fa-3x text-success"></i>
                <h4 class="mt-3 fw-bold">Prime Locations</h4>
                <p>Discover properties in the best locations across Kenya.</p>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <i class="fa-solid fa-handshake fa-3x text-warning"></i>
                <h4 class="mt-3 fw-bold">Trusted Agents</h4>
                <p>Connect with professional and verified real estate agents.</p>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <i class="fa-solid fa-credit-card fa-3x text-danger"></i>
                <h4 class="mt-3 fw-bold">Flexible Payment</h4>
                <p>Enjoy convenient and secure payment options.</p>
            </div>
        </div>
    </div>
</section>


<!-- Featured Properties -->
<div class="my-5">
    <h2 class="fw-bold text-center"><i class="fas fa-star text-warning"></i> Featured Properties</h2>
    <p class="text-center text-muted">Discover top-rated properties handpicked for you.</p>

    <div class="row">
        @foreach ($properties as $property)
            <div class="col-md-4 mb-4 d-flex">
                <div class="card shadow-lg border-0 w-100 d-flex flex-column">
                    <img src="{{ asset('storage/' . $property->image) }}" class="card-img-top property-image rounded-top" alt="{{ $property->title }}" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column justify-content-between" style="min-height: 250px;">
                        <div>
                            <h5 class="card-title fw-bold text-dark">
                                <i class="fas fa-home text-dark"></i> {{ $property->title }}
                            </h5>
                            <p class="card-text text-muted">
                                <i class="fas fa-map-marker-alt text-danger"></i> {{ $property->location }}
                            </p>
                            <p class="text-muted">{{ Str::limit($property->description, 80) }}</p>
                            <p class="fw-bold text-success"> Ksh {{ number_format($property->price) }}</p>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <a href="{{ route('properties.show', $property->id) }}" class="btn btn-outline-dark">
                                <i class="fa-solid fa-eye"></i> View Details
                            </a>
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


    </div>
</div>
   
<!-- CTA Section -->
<section class="cta-section text-center py-5" style="background: linear-gradient(rgba(44, 62, 80, 0.8), rgba(44, 62, 80, 0.9)), url('{{ asset('images/cta-bg.png') }}') center/cover;">
    <div class="container text-white">
        <h2 class="fw-bold mb-3" data-aos="fade-up">Start Your Journey to Homeownership!</h2>
        <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">Join Bingwa Homes today and take the first step in finding your perfect home.</p>
        <a href="{{ route('register') }}" class="btn btn-lg btn-warning text-dark fw-bold px-4" data-aos="zoom-in" data-aos-delay="200">
            Get Started <i class="fas fa-rocket"></i>
        </a>
    </div>
</section>

<div class="container py-5">
    <!-- Blog Section -->
    <div class="text-center" data-aos="fade-down">
        <h1 class="fw-bold text-dark">
            <i class="fas fa-newspaper text-warning"></i> Latest Blogs
        </h1>
        <p class="text-muted">
            <i class="fas fa-lightbulb text-secondary"></i> Stay informed with our latest real estate insights.
        </p>
    </div>

    <div class="row mt-4">
        @foreach($blogs as $blog)
            <div class="col-md-4" data-aos="fade-up">
                <div class="card shadow-sm border-0">
                    <img src="{{ asset('storage/blogs/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                    <div class="card-body">
                        <h5 class="card-title text-dark">
                            <i class="fas fa-book-open text-success"></i> {{ $blog->title }}
                        </h5>
                        <p class="card-text text-secondary">
                            <i class="fas fa-quote-left text-muted"></i> {{ $blog->excerpt }}
                        </p>
                        <a href="{{ route('blog.show', $blog->slug) }}" 
                            style="background-color: #7F8C8D; color: white; font-weight: bold; padding: 10px 12px; border-radius: 8px; transition: all 0.3s ease-in-out; text-decoration: none; display: inline-block;"
                            onmouseover="this.style.backgroundColor='#2C3E50'; this.style.transform='scale(1.05)';"
                            onmouseout="this.style.backgroundColor='#7F8C8D'; this.style.transform='scale(1)';">
                             <i class="fas fa-book-open"></i> Read More
                         </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('blog.index') }}" class="btn btn-outline-dark btn-hover">
            <i class="fas fa-list"></i> View All Blogs
        </a>
    </div>
</div>


@endsection
