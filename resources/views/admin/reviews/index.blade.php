@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-custom-blue">
        <i class="fas fa-star-half-alt text-gold"></i> Reviews Monitoring
    </h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="bg-custom-blue text-white text-center">
                <tr>
                    <th>#</th>
                    <th><i class="fas fa-user"></i> User</th>
                    <th><i class="fas fa-home"></i> Property</th>
                    <th><i class="fas fa-star text-gold"></i> Rating</th>
                    <th><i class="fas fa-comments"></i> Review</th>
                    <th><i class="fas fa-calendar-alt"></i> Date</th>
                    <th><i class="fas fa-tools"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $index => $review)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td><i class="fas fa-user-circle text-custom-blue"></i> {{ $review->user->name }}</td>
                        <td><i class="fas fa-building text-gold"></i> {{ $review->property->title }}</td>
                        <td>
                            <span class="badge badge-rating">{{ $review->rating }}/5 <i class="fas fa-star text-gold"></i></span>
                        </td>
                        <td class="text-start">{{ Str::limit($review->review, 50) }}</td>
                        <td>{{ $review->created_at ? $review->created_at->format('d M, Y') : 'N/A' }}</td>
                        <td>
                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $reviews->links() }}
    </div>
</div>

<!-- Custom Styling -->
<style>
    .text-custom-blue {
        color: #2C3E50 !important; /* Royal Blue */
    }

    .text-gold {
        color: #F4A62A !important; /* Gold */
    }

    .bg-custom-blue {
        background-color: #2C3E50 !important; /* Royal Blue */
    }

    .table th {
        text-align: center;
        font-weight: bold;
    }

    .table td {
        vertical-align: middle;
    }

    .badge-rating {
        background-color: #F4A62A; /* Gold */
        color: white;
        padding: 6px 10px;
        border-radius: 6px;
        font-weight: bold;
    }

    .btn-danger {
        background-color: #C0392B; /* Red */
        border: none;
        padding: 6px 12px;
        transition: 0.3s;
    }

    .btn-danger:hover {
        background-color: #A93226;
        transform: scale(1.05);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(236, 240, 241, 0.5);
    }
</style>
@endsection
