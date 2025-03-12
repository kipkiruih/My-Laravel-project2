@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h4 class="mb-3 text-primary"><i class="fas fa-cogs"></i> Admin Settings</h4>
        <hr>
        
        <div class="row">
            <!-- Backup Management -->
            <div class="col-md-6 mb-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-database"></i> Backup Management</h5>
                        <p class="card-text">Ensure your data is safe by creating backups.</p>
                        <form action="#" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-download"></i> Backup Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- User & Role Management -->
            <div class="col-md-6 mb-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-users-cog"></i> User & Role Management</h5>
                        <p class="card-text">Manage users, assign roles, and update permissions.</p>
                        <a href="{{ url('/admin/users') }}" class="btn btn-success">
                            <i class="fas fa-user-shield"></i> Manage Users
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Property Management -->
            <div class="col-md-6 mb-4">
                <div class="card border-warning shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-building"></i> Property Management</h5>
                        <p class="card-text">View, approve, or reject property listings.</p>
                        <a href="{{ url('/admin/properties') }}" class="btn btn-warning text-white">
                            <i class="fas fa-home"></i> Manage Properties
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Website Settings -->
            <div class="col-md-6 mb-4">
                <div class="card border-info shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-sliders-h"></i> Website Settings</h5>
                        <p class="card-text">Update general website configurations.</p>
                        <a href="{{ url('/admin/site-settings') }}" class="btn btn-info">
                            <i class="fas fa-tools"></i> Configure Site
                        </a>
                    </div>
                </div>
            </div>

            <!-- Security Settings -->
            <div class="col-md-6 mb-4">
                <div class="card border-danger shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-shield-alt"></i> Security Settings</h5>
                        <p class="card-text">Manage authentication and security settings.</p>
                        <a href="{{ route('security-settings.index') }}" class="btn btn-danger">
                            <i class="fas fa-user-lock"></i> Manage Security
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
