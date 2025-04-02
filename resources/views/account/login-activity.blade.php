@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <!-- Header -->
                <div class="card-header text-white text-center" style="background-color: #F4A62A;">
                    <h4><i class="fas fa-user-clock"></i> Login Activity</h4>
                </div>

                <div class="card-body">
                    <!-- Login Activity Table -->
                    <table class="table table-hover">
                        <thead style="background-color: #2C3E50; color: white;">
                            <tr>
                                <th><i class="fas fa-calendar-alt"></i> Date</th>
                                <th><i class="fas fa-globe"></i> IP Address</th>
                                <th><i class="fas fa-mobile-alt"></i> Device</th>
                                <th><i class="fas fa-window-maximize"></i> Browser</th>
                                <th><i class="fas fa-desktop"></i> Platform</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $activity)
                            <tr class="table-row">
                                <td>{{ \Carbon\Carbon::parse($activity->created_at)->format('d M Y, h:i A') }}</td>
                                <td>{{ $activity->ip_address }}</td>
                                <td>{{ $activity->device ?? 'Unknown' }}</td>
                                <td>{{ $activity->browser ?? 'Unknown' }}</td>
                                <td>{{ $activity->platform ?? 'Unknown' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    <i class="fas fa-exclamation-circle"></i> No login activity found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .table-row:hover { background-color: #F4A62A1A; } /* Light Gold Hover */
    .table th, .table td { vertical-align: middle; } /* Align content */
</style>
@endsection
