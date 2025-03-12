@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="row my-5">
        <div class="col-md-6 d-flex align-items-center">
            <div>
                <h1 class="fw-bold text-primary">Find Your Dream Home with Bingwa Homes</h1>
                <p class="lead text-muted">Explore the best properties in Kenya, from apartments to commercial buildings. Your perfect home is just a click away.</p>
                <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg"><i class="fa-solid fa-building"></i> Browse Properties</a>
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('images/dream_home') }}" alt="Dream Home" class="img-fluid rounded shadow">
        </div>
    </div>

    <!-- Features Section -->
    <div class="row text-center my-5">
        <div class="col-md-4">
            <i class="fa-solid fa-map-location-dot fa-3x text-success"></i>
            <h4 class="mt-3">Prime Locations</h4>
            <p>Discover properties in the best locations across Kenya.</p>
        </div>
        <div class="col-md-4">
            <i class="fa-solid fa-handshake fa-3x text-warning"></i>
            <h4 class="mt-3">Trusted Agents</h4>
            <p>Connect with professional and verified real estate agents.</p>
        </div>
        <div class="col-md-4">
            <i class="fa-solid fa-credit-card fa-3x text-danger"></i>
            <h4 class="mt-3">Flexible Payment</h4>
            <p>Enjoy convenient and secure payment options.</p>
        </div>
    </div>

    <!-- Featured Properties -->
    <div class="my-5">
    <h2 class="fw-bold text-center">Featured Properties</h2>
    <div class="row">
        @foreach ($properties as $property)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $property->image) }}" class="card-img-top property-image" alt="{{ $property->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($property->description, 80) }}</p>
                        <p class="fw-bold text-primary">Ksh {{ number_format($property->price) }}</p>
                        <a href="{{route('properties.index')}}" class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i> View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.property-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 5px;
}
</style>

    <!-- Call to Action -->
    <div class="text-center my-5">
        <h3 class="fw-bold">Ready to Buy or Sell?</h3>
        <p>Join thousands of satisfied clients using Bingwa Homes.</p>
        <a href="{{ url('/register') }}" class="btn btn-success btn-lg"><i class="fa-solid fa-user-plus"></i> Get Started</a>
    </div>
</div>
@endsection
