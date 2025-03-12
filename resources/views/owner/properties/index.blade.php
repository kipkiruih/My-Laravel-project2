@extends('layouts.owner')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-primary"><i class="fas fa-building"></i> My Properties</h3>
        <a href="{{ route('owner.properties.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add New Property</a>
    </div>


    <!-- Search Bar -->
    <form action="{{ route('owner.properties.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control border-secondary" placeholder="Search properties..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
        </div>
    </form>
    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No.</th>
                        <th><i class="fas fa-home"></i> Title</th>
                        <th><i class="fas fa-map-marker-alt"></i> Location</th>
                        <th><i class="fas fa-dollar-sign"></i> Price (Ksh)</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th><i class="fas fa-image"></i> Image</th>
                        <th class="text-center"><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($properties as $index => $property)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $property->title }}</td>
                        <td>{{ $property->location }}</td>
                        <td>{{ number_format($property->price, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $property->status == 'Available' ? 'success' : ($property->status == 'Rented' ? 'warning' : 'danger') }}">
                                {{ $property->status }}
                            </span>
                        </td>
                        <td>
                            @if ($property->image)
                                <img src="{{ asset('storage/' . $property->image) }}" alt="Property Image" class="img-thumbnail" width="80">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('owner.properties.edit', $property->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('owner.properties.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No properties found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
