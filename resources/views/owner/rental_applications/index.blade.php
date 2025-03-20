@extends('layouts.owner')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark"><i class="fas fa-file-alt"></i> Rental Applications</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>#</th>
                        <th><i class="fas fa-user"></i> Tenant</th>
                        <th><i class="fas fa-home"></i> Property</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th><i class="fas fa-comment"></i> Message</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $index => $application)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $application->tenant->name }}</td>
                        <td>{{ $application->property->title }}</td>
                        <td>
                            <span class="badge rounded-pill 
                                @if($application->status == 'Pending') bg-warning text-dark
                                @elseif($application->status == 'Approved') bg-success
                                @else bg-danger @endif">
                                {{ $application->status }}
                            </span>
                        </td>
                        <td>{{ $application->message ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('owner.rental_applications.show', $application->id) }}" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
