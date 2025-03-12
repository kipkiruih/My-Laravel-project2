@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Recent Notifications -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-white" style="background-color: #2C3E50;">
                    <i class="fas fa-bell"></i> Recent Notifications
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($notifications as $notification)
                            <li class="list-group-item">
                                <i class="{{ $notification->data['icon'] ?? 'fas fa-info-circle text-secondary' }}"></i>
                                {!! $notification->data['message'] ?? 'No message available' !!}
                                <small class="text-muted float-end">{{ $notification->created_at->diffForHumans() }}</small>
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center">No notifications available.</li>
                        @endforelse
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
