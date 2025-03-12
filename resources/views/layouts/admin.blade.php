<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | {{ config('app.name', 'Bingwa Homes') }}</title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg" style="background-color: #2C3E50; padding: 10px;">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand text-white fw-bold" href="#">
                    <i class="fas fa-user-shield" style="color: #F4A62A;"></i> Admin Panel
                </a>

                <!-- Mobile Menu Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Items -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- Notifications -->
                        <li class="nav-item">
                            <a class="nav-link text-white position-relative" href="#">
                                <i class="fas fa-bell fa-lg"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">5+</span>
                            </a>
                        </li>

                        <!-- User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <!-- Display Profile Image if Available, Otherwise Show Default Image -->
        <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-profile.png') }}" 
        alt="Profile" class="rounded-circle me-1" width="35" height="35">
   <span class="ms-1">{{ Auth::user()->name ?? 'Admin' }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{route('profile.edit')}}"><i class="fas fa-user"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="{{url('/admin/settings')}}"><i class="fas fa-cog"></i> Settings</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar & Content Layout -->
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                    <div class="sidebar-header text-center py-3">
                        <h4 class="text-white">Admin Dashboard</h4>
                    </div>
                    <ul class="list-unstyled px-3">
                        <li>
                            <a href="{{route('admin.dashboard')}}" class="sidebar-link active">
                                <i class="fas fa-chart-line"></i> Dashboard Overview
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.properties.index')}}" class="sidebar-link">
                                <i class="fas fa-building"></i> Manage Properties
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.users.index')}}" class="sidebar-link">
                                <i class="fas fa-users"></i> User Management
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.rental-applications.index')}}" class="sidebar-link">
                                <i class="fas fa-file-signature"></i> Rental Applications
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.reviews.index')}}" class="sidebar-link">
                                <i class="fas fa-comments"></i> Reviews & Feedback
                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.activities.index')}}" class="sidebar-link">
                                <i class="fas fa-clock"></i> Activity Log
                            </a>
                        </li>

                        <li>
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-wallet"></i> Payments & Transactions
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-chart-pie"></i> Reports & Analytics
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/admin/settings')}}" class="sidebar-link">
                                <i class="fas fa-cogs"></i> Settings
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Main Content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<button class="btn btn-warning d-lg-none" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i> Menu
</button>

<script>
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
}
</script>

</html>
