@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Rental Applications Monitoring</h2>

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
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
    <tr>
        <td>{{ $loop->iteration }}</td>

        <td>{{ $application->tenant?->name ?? 'N/A' }}</td>

        <td>{{ $application->property?->title ?? 'N/A' }}</td>

        <td>{{ $application->property?->owner?->name ?? 'N/A' }}</td> <!-- Fix owner issue -->

        <td>
            <span class="badge bg-{{ $application->status == 'approved' ? 'success' : ($application->status == 'rejected' ? 'danger' : ($application->status == 'pending' ? 'warning' : 'info')) }}">
                {{ ucfirst($application->status) }}
            </span>
        </td>

        <td>
            <a href="{{ route('admin.rental-applications.show', $application->id) }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i> View
            </a>
        </td>
    </tr>
@endforeach

        </tbody>
    </table>
</div>
@endsection
