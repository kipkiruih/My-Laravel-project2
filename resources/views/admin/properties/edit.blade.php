@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Property</h2>

    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $property->title }}" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category" class="form-control">
                <option value="apartment" {{ $property->category == 'apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="house" {{ $property->category == 'house' ? 'selected' : '' }}>House</option>
                <option value="commercial" {{ $property->category == 'commercial' ? 'selected' : '' }}>Commercial</option>
                <option value="land" {{ $property->category == 'land' ? 'selected' : '' }}>Land</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $property->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
    </form>
</div>
@endsection
