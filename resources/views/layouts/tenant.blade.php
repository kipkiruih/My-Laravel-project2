<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenant Panel | {{ config('app.name', 'Bingwa Homes') }}</title>

    <!-- Bootstrap & FontAwesome -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>
<body>
    <div id="app">
        <!-- Static Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <!-- Sidebar Toggle Button -->
                <button class="sidebar-toggle d-md-none" type="button" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <!-- Logo -->
                <a class="navbar-brand text-white fw-bold" href="{{ route('home') }}">
                    <i class="fas fa-home" style="color: #F4A62A;"></i> Bingwa Homes
                </a>

                <!-- Mobile Menu Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Items -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link text-white position-relative" href="{{ url('/properties') }}" style="color: #2C3E50;">
                                <i class="fa-solid fa-building"></i> Properties
                            </a>
                        </li>
        
                        <!-- Notifications -->
                        <li class="nav-item">
                            <a class="nav-link text-white position-relative" href="{{ route('notifications.index') }}">
                                <i class="fas fa-bell fa-lg"></i>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </a>
                        </li>

                        <!-- User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-profile.png') }}" 
                                alt="Profile" class="rounded-circle me-1" width="35" height="35">
                                <span class="ms-1">{{ Auth::user()->name ?? 'Tenant' }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
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
                     <!-- Dark Mode Toggle Button -->
            
                </div>
            </div>
        </nav>

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header text-center py-3">
                <h4 class="text-white" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <i class="fas fa-user" style="font-size: 24px; margin-bottom: 4px;"></i>
                    Tenant Panel
                </h4>
                
                            </div>
            <ul class="list-unstyled px-3 nav flex-column">
                <li>
                    <a href="{{ route('tenant.dashboard') }}" class="sidebar-link {{ Request::routeIs('tenant.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> My Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('tenant.rental_applications.index') }}" class="sidebar-link {{ Request::routeIs('tenant.rental_applications.index') ? 'active' : '' }}">
                        <i class="fas fa-file-signature"></i> Rental Applications
                    </a>
                </li>
                <li>
                    <a href="{{ route('tenant.bookmarks.index') }}" class="sidebar-link {{ Request::routeIs('tenant.bookmarks.index') ? 'active' : '' }}">
                        <i class="fas fa-bookmark"></i> Bookmarked Properties
                    </a>
                </li>
                <li>
                    <a href="{{ route('tenant.favorites.index') }}" class="sidebar-link {{ Request::routeIs('tenant.favorites.index') ? 'active' : '' }}">
                        <i class="fas fa-heart"></i> Favorites & Ratings
                    </a>
                </li>
                <li>
                    <a href="{{ route('tenant.maintenance.index') }}" class="sidebar-link {{ Request::routeIs('tenant.maintenance.index') ? 'active' : '' }}">
                        <i class="fas fa-tools"></i> Maintenance Requests
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notifications.index') }}" class="sidebar-link position-relative {{ Request::routeIs('notifications.index') ? 'active' : '' }}">
                        <i class="fas fa-bell"></i> Notifications
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="sidebar-link {{ Request::routeIs('profile.edit') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i> Profile Management
                    </a>
                </li>
                <li>
                    <a href="{{ route('payments.index') }}" class="sidebar-link {{ Request::routeIs('payments.index') ? 'active' : '' }}">
                        <i class="fas fa-wallet"></i> Payments & Rental History
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('sidebarOverlay');
            
            // Function to toggle sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }
            
            // Toggle sidebar when button is clicked
            sidebarToggle.addEventListener('click', toggleSidebar);
            
            // Close sidebar when clicking on overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
            
            // Close sidebar when window is resized to larger size
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    mainContent.style.marginLeft = "250px";
                } else {
                    mainContent.style.marginLeft = "0";
                }
            });
            
            // Close sidebar when clicking on a link (mobile only)
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                    }
                });
            });
            
            // Initialize correct layout based on screen size
            if (window.innerWidth >= 768) {
                mainContent.style.marginLeft = "250px";
            } else {
                mainContent.style.marginLeft = "0";
            }
        });
    </script>
     

</body>
</html>