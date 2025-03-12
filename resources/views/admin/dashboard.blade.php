@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Overview Cards -->
        <div class="col-md-3">
            <div class="card shadow" style="background-color: #2C3E50; color: #FFFFFF;">
                <div class="card-body">
                    <i class="fas fa-building fa-2x float-end" style="color: #F4A62A;"></i>
                    <h5 class="card-title">Total Properties</h5>
                    <h3 class="fw-bold">150</h3>
                    <small>Updated just now</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow" style="background-color: #2ECC71; color: #FFFFFF;">
                <div class="card-body">
                    <i class="fas fa-users fa-2x float-end" style="color: #F4A62A;"></i>
                    <h5 class="card-title">Total Users</h5>
                    <h3 class="fw-bold">500</h3>
                    <small>Active & registered users</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow" style="background-color: #F4A62A; color: #2C3E50;">
                <div class="card-body">
                    <i class="fas fa-file-signature fa-2x float-end" style="color: #2C3E50;"></i>
                    <h5 class="card-title">Pending Applications</h5>
                    <h3 class="fw-bold">35</h3>
                    <small>Awaiting approval</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow" style="background-color: #7F8C8D; color: #FFFFFF;">
                <div class="card-body">
                    <i class="fas fa-wallet fa-2x float-end" style="color: #F4A62A;"></i>
                    <h5 class="card-title">Total Payments</h5>
                    <h3 class="fw-bold">KES 1.2M</h3>
                    <small>Last 30 days</small>
                </div>
            </div>
        </div>
    </div>


    <!-- Recent Activity Section -->
    <!--<div class="row mt-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-white" style="background-color: #2C3E50;">
                    <i class="fas fa-clock"></i> Recent Activities
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><i class="fas fa-user-plus text-success"></i> New user <b>John Doe</b> registered</li>
                        <li class="list-group-item"><i class="fas fa-building text-primary"></i> Property <b>3-Bedroom Apartment</b> listed</li>
                        <li class="list-group-item"><i class="fas fa-check text-warning"></i> Rental application <b>#1023</b> approved</li>
                        <li class="list-group-item"><i class="fas fa-star text-danger"></i> New review added for <b>Luxury Villa</b></li>
                    </ul>
                </div>
            </div>
        </div>-->

          <!-- Placeholder for Charts -->
          <div class="col-md-4">
            <div class="card shadow">
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
