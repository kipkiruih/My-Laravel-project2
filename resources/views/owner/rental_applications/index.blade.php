@extends('layouts.owner')

@section('content')
<div class="container mt-4">
    <h2 class="text-primary">Rental Applications</h2>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Tenant</th>
                        <th>Property</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->tenant->name }}</td>
                        <td>{{ $application->property->title }}</td>
                        <td>
                            <span class="badge 
                                @if($application->status == 'Pending') bg-warning
                                @elseif($application->status == 'Approved') bg-success
                                @else bg-danger @endif">
                                {{ $application->status }}
                            </span>
                        </td>
                        <td>{{ $application->message ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('owner.rental_applications.show', $application->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
