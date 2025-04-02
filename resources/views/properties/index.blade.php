@extends('layouts.app')

@section('content')

<style>.text-primary {
    color: #2C3E50 !important; /* Royal Blue for headings */
}
.btn-primary {
    background-color: #2C3E50 !important; /* Royal Blue buttons */
    border-color: #2C3E50 !important;
}
.btn-primary:hover {
    background-color: #F4A62A !important; /* Gold on hover */
    border-color: #F4A62A !important;
}
.btn-warning {
    background-color: #F4A62A !important; /* Gold for bookmark button */
    border-color: #F4A62A !important;
}
.btn-warning:hover {
    background-color: #2C3E50 !important; /* Royal Blue on hover */
    border-color: #2C3E50 !important;
}
.btn-outline-primary {
    color: #2C3E50 !important;
    border-color: #2C3E50 !important;
}
.btn-outline-primary:hover {
    background-color: #2C3E50 !important;
    color: white !important;
}
.form-control {
    border-color: #7F8C8D !important; /* Warm Gray for input fields */
}
.form-control:focus {
    border-color: #2C3E50 !important; /* Royal Blue on focus */
    box-shadow: 0 0 5px rgba(44, 62, 80, 0.5);
}
.card {
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}
.card:hover {
    transform: scale(1.03);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}
.card-img-top {
    height: 200px;
    object-fit: cover;
}
.card-body {
    text-align: center;
}
.pagination .page-link {
    color: #2C3E50 !important;
    border-color: #2C3E50 !important;
}
.pagination .page-item.active .page-link {
    background-color: #2C3E50 !important;
    border-color: #2C3E50 !important;
}
.card {
    display: flex;
    flex-direction: column;
    height: 100%; /* Ensure all cards take full height */
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card-body {
    flex: 1; /* Makes card body take up available space */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: center;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
    width: 100%;
}

.row .col-md-4 {
    display: flex;
}

.card:hover {
    transform: scale(1.03);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

</style>

<div class="container mt-4">
    <h2 class="text-primary text-center"><i class="fas fa-building"></i> Properties Listing</h2>
    <p class="text-muted text-center">Find the perfect home that suits your lifestyle.</p>

    <!-- Search & Filter -->
    <form method="GET" action="{{ route('properties.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="🔍 Search by title..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-control">
                    <option value="">🏡 All Categories</option>
                    <option value="Apartment">🏢 Apartment</option>
                    <option value="House">🏠 House</option>
                    <option value="Land">🌿 Land</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="location" class="form-control" placeholder="📍 Location..." value="{{ request('location') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>
    </form>

    <!-- Properties Grid -->
    <div class="row">
        @foreach($properties as $property)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $property->image) }}" class="card-img-top" alt="{{ $property->title }}">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-home text-primary"></i> {{ $property->title }}</h5>
                        <p class="text-muted"><i class="fas fa-map-marker-alt text-danger"></i> {{ $property->location }}</p>
                        <p class="text-success fw-bold"><i class="fas fa-dollar-sign"></i> Ksh {{ number_format($property->price, 2) }}</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <form action="{{ in_array($property->id, $bookmarkedProperties ?? []) 
                                ? route('tenant.bookmarks.destroy', $property->id) 
                                : route('tenant.bookmarks.store') }}" 
                                method="POST">
                                
                                @csrf
                                @if (in_array($property->id, $bookmarkedProperties ?? []))
                                    @method('DELETE')
                                @endif
                                
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <button type="submit" class="btn {{ in_array($property->id, $bookmarkedProperties ?? []) ? 'btn-outline-primary' : 'btn-warning' }}">
                                    <i class="fas fa-bookmark"></i> 
                                    {{ in_array($property->id, $bookmarkedProperties ?? []) ? 'Bookmarked' : 'Bookmark' }}
                                </button>
                            </form>
                            
                            
                            <form action="{{ in_array($property->id, $favoritedProperties ?? []) 
                                ? route('tenant.favorites.destroy', $property->id) 
                                : route('tenant.favorites.store') }}" 
                                method="POST">
                                @csrf
                                @if(in_array($property->id, $favoritedProperties ?? []))
                                    @method('DELETE') 
                                    <button class="btn btn-danger">
                                        <i class="fas fa-heart-broken"></i> Added to Favorites
                                    </button>
                                @else
                                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                                    <button class="btn btn-outline-primary">
                                        <i class="fas fa-heart"></i> Add to Favorites
                                    </button>
                                @endif
                            </form>
                            
                        </div>

                        <hr>

                        <div class="d-flex align-items-center justify-content-center">
                            @php
                                $averageRating = round($property->averageRating() ?? 0, 1);
                            @endphp
                            <span class="text-warning">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $averageRating ? '' : '-o' }}"></i>
                                @endfor
                            </span>
                            <span class="ms-2 text-muted">({{ $averageRating }}/5)</span>
                        </div>
                        
                        <a href="{{ route('properties.show', $property->id) }}" class="btn btn-primary w-100">
                            <i class="fas fa-eye"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $properties->links() }}
    </div>
</div>

@endsection
