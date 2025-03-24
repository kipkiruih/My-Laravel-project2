@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center" style="color: #2C3E50;">
            <i class="fas fa-building"></i> Property Management
        </h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Search & Sort Form -->
        <form method="GET" action="{{ route('admin.properties.index') }}" class="mb-3 d-flex">
            <!-- Search Bar -->
            <div class="input-group">
                <input type="text" name="search" class="form-control border-2" placeholder="🔍 Search properties..." value="{{ request('search') }}">
                <button type="submit" class="btn custom-btn-gold">Search</button>
            </div>

            <!-- Sort Dropdown -->
            <select name="sort" class="form-select ms-2" onchange="this.form.submit()">
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Sort by Title</option>
                <option value="owner" {{ request('sort') == 'owner' ? 'selected' : '' }}>Sort by Owner</option>
                <option value="property_type" {{ request('sort') == 'property_type' ? 'selected' : '' }}>Sort by Propery Type</option>
                <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Sort by Status</option>
            </select>
        </form>

        <table class="table table-striped">
            <thead style="background-color: #F4A62A; color: white;">
                <tr>
                    <th>#</th>
                    <th><i class="fas fa-home"></i> Title</th>
                    <th><i class="fas fa-user"></i> Owner</th>
                    <th><i class="fas fa-layer-group"></i> Property Type</th>
                    <th><i class="fas fa-check-circle"></i> Status</th>
                    <th><i class="fas fa-tools"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $property->title }}</td>
                    <td>{{ $property->owner->name }}</td>
                    <td>{{ ucfirst($property->property_type) }}</td>
                    <td>
                        <span class="badge bg-{{ $property->status == 'approved' ? 'success' : ($property->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($property->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-warning btn-sm custom-hover"><i class="fas fa-edit"></i></a>

                        @if($property->status != 'approved')
                            <form action="{{ route('admin.properties.approve', $property->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm custom-hover"><i class="fas fa-check"></i></button>
                            </form>
                        @endif

                        @if($property->status != 'rejected')
                            <form action="{{ route('admin.properties.reject', $property->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm custom-hover"><i class="fas fa-times"></i></button>
                            </form>
                        @endif

                        <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-dark btn-sm custom-hover"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $properties->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Custom Buttons */
    .custom-btn-gold {
        background-color: #F4A62A;
        color: white;
        padding: 8px 15px;
        border-radius: 6px;
        transition: all 0.3s ease-in-out;
    }

    .custom-btn-gold:hover {
        background-color: #D18A1B;
        color: white;
        transform: scale(1.05);
    }

    /* Hover Effect for Action Buttons */
    .custom-hover:hover {
        transform: scale(1.1);
        transition: 0.3s;
    }

    /* Search Bar */
    .input-group input {
        border-radius: 8px;
        padding-left: 15px;
    }
</style>
@endsection
