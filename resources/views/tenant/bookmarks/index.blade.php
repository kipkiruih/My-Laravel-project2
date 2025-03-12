@extends('layouts.tenant')

@section('content')
<div class="container mt-4">
    <h2 class="text-primary mb-3"><i class="fas fa-bookmark"></i> Bookmarked Properties</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($bookmarks->count() > 0)
        <div class="row">
            @foreach ($bookmarks as $bookmark)
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' . $bookmark->property->image) }}" class="card-img-top" alt="Property">
                        <div class="card-body">
                            <h5 class="card-title">{{ $bookmark->property->title }}</h5>
                            <p class="card-text">{{ Str::limit($bookmark->property->description, 80) }}</p>
                            <a href="{{ route('properties.show', $bookmark->property->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <form action="{{ route('tenant.bookmarks.destroy', $bookmark->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
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
