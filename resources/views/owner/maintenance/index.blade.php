@extends('layouts.owner')

@section('content')
<div class="container">
    <h2>Maintenance Requests</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Property</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Requested On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($maintenanceRequests as $request)
                <tr>
                    <td>{{ $request->property->title ?? 'N/A' }}</td>
                    <td>{{ $request->subject }}</td>
                    <td>
                        <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'completed' ? 'success' : 'primary') }}">
                            {{ ucfirst($request->status) }}
                        </span>
                    </td>
                    <td>{{ $request->created_at ? $request->created_at->format('d M Y H:i A') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('owner.maintenance.show', $request->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No maintenance requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
