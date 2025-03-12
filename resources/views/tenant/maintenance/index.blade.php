@extends('layouts.tenant')

@section('content')
<div class="container">
    <h2>Maintenance Requests</h2>
    <a href="{{ route('tenant.maintenance.create') }}" class="btn btn-primary mb-3">New Request</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Property</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td>{{ $request->property->title }}</td>
                <td>{{ $request->subject }}</td>
                <td>
                    <span class="badge bg-{{ $request->status == 'Completed' ? 'success' : ($request->status == 'In Progress' ? 'warning' : 'danger') }}">
                        {{ $request->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('tenant.maintenance.show', $request->id) }}" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
