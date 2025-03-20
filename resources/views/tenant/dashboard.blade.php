@extends('layouts.tenant')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
<!-- Overview Section -->
<div class="row">
    <div class="col-md-3">
        <div class="card shadow h-100" style="background-color: #2C3E50; color: #FFFFFF;">
            <div class="card-body">
                <i class="fas fa-home fa-2x float-end" style="color: #F4A62A;"></i>
                <h5 class="card-title">My Rentals</h5>
                <h3 class="fw-bold">{{ $occupiedRentals }}</h3>
                <small>Currently occupied properties</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow h-100" style="background-color: #F4A62A; color: #2C3E50;">
            <div class="card-body">
                <i class="fas fa-file-signature fa-2x float-end" style="color: #2C3E50;"></i>
                <h5 class="card-title">Pending Applications</h5>
                <h3 class="fw-bold">{{ $pendingApplications }}</h3>
                <small>Waiting for approval</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow h-100" style="background-color: #2ECC71; color: #FFFFFF;">
            <div class="card-body">
                <i class="fas fa-wallet fa-2x float-end" style="color: #F4A62A;"></i>
                <h5 class="card-title">Total Payments</h5>
                <h3 class="fw-bold">KES {{ number_format($totalPayments, 2) }}</h3>
                <small>Last 6 months</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow h-100" style="background-color: #7F8C8D; color: #FFFFFF;">
            <div class="card-body">
                <i class="fas fa-bookmark fa-2x float-end" style="color: #F4A62A;"></i>
                <h5 class="card-title">Bookmarked</h5>
                <h3 class="fw-bold">{{ $bookmarkedProperties }}</h3>
                <small>Saved properties</small>
            </div>
        </div>
    </div>
</div>


    <!-- Notifications & Payments Section -->
    <div class="row mt-4">
        <!-- Recent Notifications -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-white" style="background-color: #2C3E50;">
                    <i class="fas fa-bell"></i> Recent Notifications
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><i class="fas fa-check text-success"></i> Your rental application for <b>2-Bedroom Apartment</b> was approved</li>
                        <li class="list-group-item"><i class="fas fa-wallet text-warning"></i> Payment of <b>KES 15,000</b> received for <b>Luxury Apartment</b></li>
                        <li class="list-group-item"><i class="fas fa-exclamation-triangle text-danger"></i> Rent due for <b>Studio Apartment</b> in 5 days</li>
                        <li class="list-group-item"><i class="fas fa-star text-primary"></i> Your review was posted for <b>Urban Suites</b></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Payment Due Reminder -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header text-white" style="background-color: #2ECC71;">
                    <i class="fas fa-calendar-alt"></i> Upcoming Payments
                </div>
                <div class="card-body text-center">
                    @if ($upcomingPayment)
                        <p class="text-muted">
                            Your next rent payment of <b>KES {{ number_format($upcomingPayment->amount, 2) }}</b> 
                            is due on <b>{{ \Carbon\Carbon::parse($upcomingPayment->due_date)->format('F d, Y') }}</b>.
                        </p>
                        <a href="{{ route('payments.pay_rent') }}" class="btn text-white" style="background-color: #F4A62A;">
                            <i class="fas fa-credit-card"></i> Pay Now
                        </a>
                    @else
                        <p class="text-muted">No upcoming payments at the moment.</p>
                    @endif
                </div>
            </div>
        </div>
        
       
        
    </div>
</div>
@endsection
