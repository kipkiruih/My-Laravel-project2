@extends('layouts.owner')
@section('content')
@if(Auth::user()->is_deactivated)
    <div class="alert alert-warning">
        Your account is deactivated. Contact support to reactivate.
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif


<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container mt-4">
        <h2 class="mb-4 text-dark">Welcome, {{ Auth::user()->name ?? 'Owner' }}</h2>
        
        
      <!-- Dashboard Overview Cards -->
<div class="row">
    <div class="col-md-4">
        <div class="card p-3 shadow h-100">
            <div class="d-flex align-items-center">
                <div class="icon-box" style="background-color: #F4A62A; padding: 15px; border-radius: 50%;">
                    <i class="fas fa-home fa-2x" style="color: #FFFFFF;"></i>
                </div>
                <div class="ms-3">
                    <h5 class="card-title">Total Properties</h5>
                    <h3>{{ $totalProperties }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow h-100">
            <div class="d-flex align-items-center">
                <div class="icon-box" style="background-color: #2ECC71; padding: 15px; border-radius: 50%;">
                    <i class="fas fa-users fa-2x" style="color: #FFFFFF;"></i>
                </div>
                <div class="ms-3">
                    <h5 class="card-title">Total Tenants</h5>
                    <h3>{{ $totalTenants }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow h-100">
            <div class="d-flex align-items-center">
                <div class="icon-box" style="background-color: #F4A62A; padding: 15px; border-radius: 50%;">
                    <i class="fas fa-money-bill-wave fa-2x" style="color: #2C3E50;"></i>
                </div>
                <div class="ms-3">
                    <h5 class="card-title">Total Earnings</h5>
                    <h3>KES {{ number_format($totalEarnings) }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center p-3">
                    <i class="fas fa-plus-circle fa-2x text-success"></i>
                    <h5 class="mt-2">Add New Property</h5>
                    <a href="{{route('owner.properties.create')}}" class="btn btn-outline-success btn-sm mt-2">Add Property</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center p-3">
                    <i class="fas fa-user-friends fa-2x text-primary"></i>
                    <h5 class="mt-2">View Tenants</h5>
                    <a href="{{route('owner.tenants.index')}}" class="btn btn-outline-primary btn-sm mt-2">Manage Tenants</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center p-3">
                    <i class="fas fa-file-invoice-dollar fa-2x text-warning"></i>
                    <h5 class="mt-2">Track Payments</h5>
                    <a href="{{route('owner.payments')}}" class="btn btn-outline-warning btn-sm mt-2">View Payments</a>
                </div>
            </div>

            <!-- Add Maintenance Requests Link -->
    <div class="col-md-4">
        <div class="card text-center p-3">
            <i class="fas fa-tools fa-2x text-warning"></i> <!-- Maintenance Icon -->
            <h5 class="mt-2">Maintenance Requests</h5>
            <a href="{{ route('owner.maintenance.index') }}" class="btn btn-outline-warning btn-sm mt-2">
                View Requests
            </a>
    </div>
</div>
              <!-- Add Rental Applications Link -->
    <div class="col-md-4">
        <div class="card text-center p-3">
            <i class="fas fa-list-check fa-2x text-info"></i>
            <h5 class="mt-2">Rental Applications</h5>
            <a href="{{ route('owner.rental_applications.index') }}" class="btn btn-outline-info btn-sm mt-2">
                View Applications
            </a>
        </div>
    </div>

        </div>

      

        <!-- Recent Activities -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card p-3">
                    <h5 class="card-title">Recent Activities</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-money-check-alt text-success"></i> Tenant John Doe paid KES 25,000 for Property #101.
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-user-plus text-primary"></i> New tenant Jane Smith has moved into Property #205.
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-home text-warning"></i> You listed a new property in Nairobi.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
  <!-- Notifications -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card p-3">
                    <h5 class="card-title   ">Notifications</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($notifications as $notification)
                        <li class="list-group-item">
                            {{ $notification->data['message'] }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
                
                        


    </div>
</main>

<!-- Custom Styles for Cards & Icons -->
<style>
    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .card-title {
        color: #2C3E50;
        font-weight: bold;
    }
    .icon-box {
        width: 50px;
        height: 50px;
        background-color: #F4A62A;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    Echo.private('App.Models.User.{{ auth()->id() }}')
        .notification((notification) => {
            alert(notification.message);
            location.reload(); // Refresh to show new notifications
        });
</script>


@endsection