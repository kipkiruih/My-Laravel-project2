@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #2C3E50; color: white;">
            <h4 class="mb-0"><i class="fas fa-users"></i> User Management</h4>
            <form class="d-flex" method="GET" action="{{ route('admin.users.index') }}">
                <input class="form-control me-2" type="search" name="search" placeholder="Search users..." aria-label="Search">
                <button class="btn" type="submit" style="background-color: #F4A62A; color: white;">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead style="background-color: #F4A62A; color: white;">
                        <tr>
                            <th>#</th>
                            <th><i class="fas fa-user"></i> Name</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-phone"></i> Phone</th>
                            <th><i class="fas fa-user-tag"></i> Role</th>
                            <th><i class="fas fa-toggle-on"></i> Status</th>
                            <th><i class="fas fa-user-slash"></i> Account</th>
                            <th><i class="fas fa-tools"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td><span class="badge text-white" style="background-color: #7F8C8D;">{{ ucfirst($user->role) }}</span></td>
                            <td>
                                <span class="badge text-white"
                                    style="background-color: {{ $user->status == 'approved' ? '#2ECC71' : ($user->status == 'suspended' ? '#E74C3C' : '#F39C12') }};">
                                    <i class="fas 
                                        {{ $user->status == 'approved' ? 'fa-check-circle' : ($user->status == 'suspended' ? 'fa-ban' : 'fa-exclamation-triangle') }}"></i>
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td>
                                @if($user->is_deactivated)
                                <span class="badge text-white" style="background-color: #E74C3C;">
                                    <i class="fas fa-user-slash"></i> Deactivated
                                </span>
                            @else
                                <span class="badge text-white" style="background-color: #2ECC71;">
                                    <i class="fas fa-user-check"></i> Active
                                </span>
                            @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm" 
                                    style="background-color: #F4A62A; color: white;" data-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            
                                @if($user->status != 'approved')
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm" 
                                            style="background-color: #2ECC71; color: white;" data-toggle="tooltip" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                            
                                @if($user->status != 'suspended')
                                    <form action="{{ route('admin.users.suspend', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm" 
                                            style="background-color: #E74C3C; color: white;" data-toggle="tooltip" title="Suspend">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                @endif
                            
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" 
                                        style="background-color: #7F8C8D; color: white;" data-toggle="tooltip" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            
                                @if($user->is_deactivated)
                                    <form action="{{ route('admin.activate.user', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" data-toggle="tooltip" title="Reactivate">
                                            <i class="fas fa-user-check"></i> Reactivate
                                        </button>
                                    </form>
                                @endif
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

{{-- Enable Bootstrap tooltips --}}
@push('scripts')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush

@endsection
