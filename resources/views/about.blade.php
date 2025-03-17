@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Page Title -->
    <div class="text-center" data-aos="fade-down">
        <h1 class="fw-bold text-primary">About Bingwa Homes</h1>
        <p class="text-muted">Your Trusted Real Estate Partner</p>
    </div>

    <!-- About Section -->
    <div class="row mt-5 align-items-center">
        <div class="col-md-6" data-aos="fade-right">
            <img src="{{ asset('images/about.png') }}" alt="About Bingwa Homes" class="img-fluid rounded shadow about-img">
        </div>
        <div class="col-md-6" data-aos="fade-left">
            <h2 class="text-dark">Who We Are</h2>
            <p class="text-secondary fade-in-text">
                Bingwa Homes is a premier real estate platform dedicated to connecting property owners, tenants, and investors with the best real estate opportunities.
            </p>
            <h3 class="text-dark mt-4">Our Mission</h3>
            <p class="text-secondary fade-in-text">
                To revolutionize the real estate industry by providing a user-friendly, secure, and efficient property management system.
            </p>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-5 text-center">
        <div class="col-md-4">
            <div class="feature-box p-4 shadow-sm rounded bg-light" data-aos="zoom-in">
                <i class="fas fa-home fa-3x text-success"></i>
                <h4 class="mt-3 text-dark">Verified Listings</h4>
                <p class="text-secondary">Every property listed is verified to ensure credibility and transparency.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box p-4 shadow-sm rounded bg-light" data-aos="zoom-in" data-aos-delay="200">
                <i class="fas fa-users fa-3x text-primary"></i>
                <h4 class="mt-3 text-dark">User-Friendly</h4>
                <p class="text-secondary">Our platform is designed to be easy to use for all users.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box p-4 shadow-sm rounded bg-light" data-aos="zoom-in" data-aos-delay="400">
                <i class="fas fa-shield-alt fa-3x text-warning"></i>
                <h4 class="mt-3 text-dark">Secure Transactions</h4>
                <p class="text-secondary">We ensure safe and smooth transactions for property deals.</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="text-center mt-5" data-aos="fade-up">
        <a href="{{ route('properties.index') }}" class="btn btn-warning px-4 py-2 fw-bold btn-hover">Explore Properties</a>
    </div>
</div>
@endsection
