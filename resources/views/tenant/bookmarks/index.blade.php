@extends('layouts.tenant')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3" style="color: #2C3E50;">
        <i class="fas fa-bookmark"></i> Bookmarked Properties
    </h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($bookmarks->count() > 0)
        <div class="row">
            @foreach ($bookmarks as $bookmark)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <img src="{{ asset('storage/' . $bookmark->property->image) }}" class="card-img-top rounded-top-3" alt="Property">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: #2C3E50;">{{ $bookmark->property->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($bookmark->property->description, 80) }}</p>
                            
                            <a href="{{ route('properties.show', $bookmark->property->id) }}" 
                               class="btn text-white btn-sm shadow-sm fw-bold"
                               style="background-color: #2C3E50; transition: background-color 0.3s, transform 0.2s;"
                               onmouseover="this.style.backgroundColor='#1F2A36'; this.style.transform='scale(1.05)';"
                               onmouseout="this.style.backgroundColor='#2C3E50'; this.style.transform='scale(1)';">
                                <i class="fas fa-eye"></i> View
                            </a>

                            <form action="{{ route('tenant.bookmarks.destroy', $bookmark->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger btn-sm shadow-sm fw-bold"
                                        style="transition: transform 0.2s;"
                                        onmouseover="this.style.transform='scale(1.05)';"
                                        onmouseout="this.style.transform='scale(1)';">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No bookmarked properties yet.</p>
    @endif
</div>
@endsection
