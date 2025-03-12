@extends('layouts.app')

@section('content')

<style>
    .text-primary {
        color: #2ECC71 !important; /* Emerald Green for headings */
    }
    .btn-primary {
        background-color: #2ECC71 !important; /* Emerald Green buttons */
        border-color: #2ECC71 !important;
    }
    .btn-warning {
        background-color: #7F8C8D !important; /* Warm Gray for bookmark button */
        border-color: #7F8C8D !important;
    }
    .btn-warning:hover {
        background-color: #2ECC71 !important; /* Emerald Green on hover */
        border-color: #2ECC71 !important;
    }
    .form-control {
        border-color: #7F8C8D !important; /* Warm Gray for input fields */
    }
    .form-control:focus {
        border-color: #2ECC71 !important; /* Emerald Green on focus */
        box-shadow: 0 0 5px rgba(46, 204, 113, 0.5);
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    .card-body {
        text-align: center;
    }
    .row .col-md-4 {
        display: flex;
    }
    .card {
        flex: 1;
    }
</style>

<div class="container mt-4">
    <h2 class="text-primary"><i class="fas fa-home"></i> Properties Listing</h2>

    <!-- Search & Filter -->
    <form method="GET" action="{{ route('properties.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-control">
                    <option value="" style="color: #2ECC71; font-weight: bold;">All Categories</option>
                    <option value="Apartment">Apartment</option>
                    <option value="House">House</option>
                    <option value="Land">Land</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="location" class="form-control" placeholder="Location..." value="{{ request('location') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>
    </form>

    <!-- Properties Grid -->
    <div class="row">
        @foreach($properties as $property)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $property->image) }}" class="card-img-top" alt="Property">
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <p class="text-muted">{{ $property->location }}</p>
                        <p class="text-success">Ksh {{ number_format($property->price, 2) }}</p>
                        <form action="{{ route('tenant.bookmarks.store') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            @php
                                $isBookmarked = in_array($property->id, $bookmarkedProperties ?? []);
                            @endphp
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-bookmark"></i> {{ $isBookmarked ? 'Bookmarked' : 'Bookmark' }}
                            </button>
                        </form>
                        <form action="{{ route('tenant.favorites.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <button class="btn btn-outline-primary"><i class="fas fa-heart"></i> Add to Favorites</button>
                        </form>
                        <hr>                        
                        <a href="{{ route('properties.show', $property->id) }}" class="btn btn-primary">
                            <i class="fas fa-eye"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $properties->links() }}
</div>
@endsection
