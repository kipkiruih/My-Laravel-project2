@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #2C3E50;">
            <h4 class="mb-0">
                <i class="fas fa-list"></i> Activity Logs
            </h4>
            <a href="javascript:history.back()" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead style="background-color: #F4A62A; color: #fff;">
                        <tr>
                            <th>#</th>
                            <th><i class="fas fa-user"></i> User</th>
                            <th><i class="fas fa-tasks"></i> Action</th>
                            <th><i class="fas fa-info-circle"></i> Description</th>
                            <th><i class="fas fa-globe"></i> IP Address</th>
                            <th><i class="fas fa-calendar-alt"></i> Date</th>
                            <th><i class="fas fa-cog"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $log)
                        <tr style="background-color: #7F8C8D; color: #fff;">
                            <td>{{ $log->id }}</td>
                            <td>
                                <i class="fas fa-user-circle text-white"></i> 
                                {{ $log->user->name ?? 'System' }}
                            </td>
                            <td>
                                <span class="badge" style="background-color: #F4A62A; color: #fff;">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td>{{ $log->description }}</td>
                            <td><i class="fas fa-map-marker-alt"></i> {{ $log->ip_address }}</td>
                            <td>{{ $log->created_at->format('d M Y H:i:s') }}</td>
                            <td>
                                <form action="{{ route('admin.activity_logs.destroy', $log->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Are you sure you want to delete this log?');">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $activities->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
