@extends('layouts.owner')

@section('content')
<div class="container mt-4">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 style="color: #2C3E50;">
                <i class="fas fa-tools"></i> Maintenance Requests
            </h2>
            <span class="badge fs-5" style="background-color: #7F8C8D; color: #ffffff;">
                <i class="fas fa-list"></i> Total: {{ $maintenanceRequests->count() }}
            </span>
        </div>
    </div>
    

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #2ECC71; color: #fff;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover border">
            <thead style="background-color: #2C3E50; color: white;">
                <tr>
                    <th><i class="fas fa-home"></i> Property</th>
                    <th><i class="fas fa-image"></i> Image</th>
                    <th><i class="fas fa-exclamation-circle"></i> Subject</th>
                    <th><i class="fas fa-info-circle"></i> Status</th>
                    <th><i class="fas fa-calendar-alt"></i> Requested On</th>
                    <th><i class="fas fa-cogs"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($maintenanceRequests as $request)
                    <tr>
                        <td>{{ $request->property->title ?? 'N/A' }}</td>
                        <td>
                            @if($request->property->image)
                                <img src="{{ asset('storage/' . $request->property->image) }}" 
                                     alt="Property Image" class="img-thumbnail" width="80">
                            @else
                                <span class="text-muted"><i class="fas fa-ban"></i> No Image</span>
                            @endif
                        </td>
                        <td>{{ $request->subject }}</td>
                        <td>
                            <span class="badge" 
                                  style="background-color: 
                                    {{ $request->status == 'pending' ? '#F4A62A' : 
                                       ($request->status == 'completed' ? '#2ECC71' : '#7F8C8D') }}; 
                                    color: #fff;">
                                <i class="fas {{ $request->status == 'pending' ? 'fa-clock' : 
                                    ($request->status == 'completed' ? 'fa-check' : 'fa-spinner') }}"></i>
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td>{{ $request->created_at ? $request->created_at->format('d M Y H:i A') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('owner.maintenance.show', $request->id) }}" 
                               class="btn btn-sm" 
                               style="background-color: #2C3E50; color: #fff;">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            <i class="fas fa-info-circle"></i> No maintenance requests found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
