@extends('layouts.tenant')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4" style="color: #2C3E50;">
        <i class="fas fa-heart"></i> Favorite Properties
    </h2>
    
    @if ($favorites->count() > 0)
        <div class="row">
            @foreach($favorites as $favorite)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $favorite->property->image) }}" class="card-img-top rounded-top-4" alt="Property Image">
                            <span class="badge position-absolute top-0 end-0 m-2 text-white px-3 py-2 rounded-pill fw-bold" style="background-color: #F4A62A;">
                                <i class="fas fa-map-marker-alt"></i> {{ $favorite->property->location }}
                            </span>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: #2C3E50;">{{ $favorite->property->title }}</h5>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href="{{ route('properties.show', $favorite->property->id) }}" 
                                   class="btn text-white fw-bold px-3 py-2 shadow-sm"
                                   style="background-color: #2C3E50; transition: background-color 0.3s, transform 0.2s;"
                                   onmouseover="this.style.backgroundColor='#1F2A36'; this.style.transform='scale(1.05)';"
                                   onmouseout="this.style.backgroundColor='#2C3E50'; this.style.transform='scale(1)';">
                                    <i class="fas fa-eye"></i> View
                                </a>

                                <form action="{{ route('tenant.favorites.destroy', $favorite->property->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger fw-bold px-3 py-2 shadow-sm"
                                            style="transition: transform 0.2s;"
                                            onmouseover="this.style.transform='scale(1.05)';"
                                            onmouseout="this.style.transform='scale(1)';">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted text-center mt-4">You haven't added any favorite properties yet.</p>
    @endif
</div>
@endsection
