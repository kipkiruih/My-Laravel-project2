<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owner Dashboard | {{ config('app.name', 'Bingwa Homes') }}</title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    <i class="fas fa-building" style="color: #F4A62A;"></i> Bingwa Homes
                </a>

                <!-- Mobile Menu Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Items -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- Notifications Icon 
                        <li class="nav-item">
                            <a class="nav-link text-white position-relative" href="#">
                                <i class="fas fa-bell fa-lg"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3+
                                </span>
                            </a>
                        </li>-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i> 
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="badge bg-white text-dark border border-dark">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <a class="dropdown-item" href="{{ $notification->data['url'] }}">
                                        <i class="fas fa-star"></i> {{ $notification->data['message'] }}
                                    </a>
                                @empty
                                    <span class="dropdown-item text-muted">No new notifications</span>
                                @endforelse
                            </div>
                        </li>
                        
                        

                       <!-- User Dropdown -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
        <!-- Display Profile Image if Available, Otherwise Show Default Image -->
        <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-profile.png') }}" 
             alt="Profile" class="rounded-circle me-1" width="35" height="35">
        <span class="ms-1">{{ Auth::user()->name ?? 'Owner' }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="{{route('profile.edit')}}"><i class="fas fa-user"></i> Profile</a></li>
        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
        <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                        <h4 class="text-white">Owner Dashboard</h4>
                    </div>

                   

                    <ul class="list-unstyled px-3">

                        <li>
                            <a href="{{route('owner.dashboard')}}" class="sidebar-link active">
                                <i class="fas fa-tachometer"></i> My Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{route('owner.properties.index')}}" class="sidebar-link ">
                                <i class="fas fa-home"></i> My Properties
                            </a>
                        </li>
                        <li>
                            <a href="{{route('owner.properties.create')}}" class="sidebar-link">
                                <i class="fas fa-plus-circle"></i> Add New Property
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-users"></i> Manage Tenants
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-comments"></i> Reviews & Feedback
                            </a>
                        </li>
                        <li>
                            <a href="{{route('owner.payments')}}" class="sidebar-link">
                                <i class="fas fa-file-invoice-dollar"></i> Rental Payments
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-chart-line"></i> Earnings & Reports
                            </a>
                        </li>
                        
                       <!-- <li class="nav-item dropdown">
                            <a class="nav-link text-white position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell fa-lg"></i>
                        
                                @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </a>
                        
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                                @if(auth()->check())
                                    @forelse(auth()->user()->notifications as $notification)
                                        <li class="list-group-item dropdown-item">
                                            {{ $notification->data['message'] }}
                                            <span class="badge bg-primary">{{ $notification->created_at->diffForHumans() }}</span>
                                        </li>
                                    @empty
                                        <li class="dropdown-item text-muted">No notifications</li>
                                    @endforelse
                                @else
                                    <li class="dropdown-item text-muted">Log in to view notifications</li>
                                @endif
                            </ul>
                        </li> -->
                        
                        
                        
                        <li>
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-cogs"></i> Account Settings
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

    <!-- Mobile Sidebar Toggle Button -->
    <button class="btn btn-warning d-lg-none position-fixed bottom-0 end-0 m-3" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i> Menu
    </button>

    <!-- Bootstrap JS -->

    <script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
    }
    </script>
    <script>
        Echo.private('App.Models.User.{{ auth()->id() }}')
            .notification((notification) => {
                alert(notification.message);
                location.reload(); // Refresh to show new notifications
            });
    </script>
    <script>
        Echo.private('user.{{ auth()->id() }}')
            .listen('.RentalApplicationUpdated', (e) => {
                alert(e.message);
                location.reload(); // Refresh page to update status
            });
    </script>
    
    
    
</body>
</html>
