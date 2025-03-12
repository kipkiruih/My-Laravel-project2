@extends('layouts.tenant')

@section('content')
<div class="container mt-4">
    <h2 class="text-primary"><i class="fas fa-heart"></i> Favorite Properties</h2>
    
    <div class="row">
        @forelse($favorites as $favorite)
            <div class="col-md-4">
                <div class="card shadow-lg border-0">
                    <img src="{{ asset('storage/' . $favorite->property->image) }}" class="card-img-top" alt="Property Image">

                    <div class="card-body">
                        <h5 class="card-title text-dark">{{ $favorite->property->title }}</h5>
                        <p class="text-muted">{{ $favorite->property->location }}</p>
                        <form action="{{ route('tenant.favorites.destroy', $favorite->property->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="fas fa-trash"></i> Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">You haven't added any favorite properties yet.</p>
        @endforelse
    </div>
</div>
@endsection
