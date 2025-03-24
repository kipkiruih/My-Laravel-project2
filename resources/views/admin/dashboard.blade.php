@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Overview Cards -->
        <div class="col-md-3">
            <div class="card shadow h-100" style="background-color: #2C3E50; color: #FFFFFF;">
                <div class="card-body d-flex flex-column">
                    <i class="fas fa-building fa-2x float-end" style="color: #F4A62A;"></i>
                    <h5 class="card-title">Total Properties</h5>
                    <h3 class="fw-bold mt-auto">{{ $totalProperties }}</h3> <!-- Dynamic Count -->
                    <small>Updated just now</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow h-100" style="background-color: #2ECC71; color: #FFFFFF;">
                <div class="card-body d-flex flex-column">
                    <i class="fas fa-users fa-2x float-end" style="color: #F4A62A;"></i>
                    <h5 class="card-title">Total Users</h5>
                    <h3 class="fw-bold mt-auto">{{ $totalUsers }}</h3> <!-- Dynamic Count -->
                    <small>Active & registered users</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow h-100" style="background-color: #F4A62A; color: #2C3E50;">
                <div class="card-body d-flex flex-column">
                    <i class="fas fa-file-signature fa-2x float-end" style="color: #2C3E50;"></i>
                    <h5 class="card-title">Pending Applications</h5>
                    <h3 class="fw-bold mt-auto">{{ $pendingApplications }}</h3> <!-- Dynamic Count -->
                    <small>Awaiting approval</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow h-100" style="background-color: #7F8C8D; color: #FFFFFF;">
                <div class="card-body d-flex flex-column">
                    <i class="fas fa-wallet fa-2x float-end" style="color: #F4A62A;"></i>
                    <h5 class="card-title">Total Payments</h5>
                    <h3 class="fw-bold mt-auto">KES {{ number_format($totalPayments, 2) }}</h3> <!-- Dynamic Count -->
                    <small>Last 30 days</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Placeholder for Charts -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-header text-white" style="background-color: #2ECC71;">
                    <i class="fas fa-chart-line"></i> Statistics Overview
                </div>
                <div class="card-body text-center">
                    <p class="text-muted">Chart.js or Laravel Charts can be integrated here</p>
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-chart-pie fa-3x" style="color: #F4A62A;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
