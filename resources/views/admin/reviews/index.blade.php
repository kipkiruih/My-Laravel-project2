@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="fas fa-comments"></i> Reviews & Feedback Moderation</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Tenant</th>
                <th>Property</th>
                <th>Owner</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $review->tenant->name }}</td>
                <td>{{ $review->property->title }}</td>
                <td>{{ $review->owner->name }}</td>
                <td>
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-star"></i> {{ $review->rating }} / 5
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
