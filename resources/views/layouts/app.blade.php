<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingwa Homes</title>
       <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

       @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
       
        .footer {
            background-color: #2C3E50;
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-top: 20px;
        }
    </style>

</head>
<body>

    <!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}" style="color: #2C3E50;">
            <i class="fa-solid fa-house-chimney"></i> Bingwa Homes
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('/') }}" style="color: #2C3E50;">
                        <i class="fa-solid fa-home"></i> Home
                    </a>
                </li>

               

            
                @guest
                <li>
                    <a class="nav-link fw-semibold" href="{{ url('/properties') }}" style="color: #2C3E50;">
                        <i class="fa-solid fa-building"></i> Properties
                    </a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('login') }}" style="color: #2C3E50;">
                            <i class="fa-solid fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('register') }}" style="color: #2C3E50;">
                            <i class="fa-solid fa-user-plus"></i> Register
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="
                            @if(Auth::user()->role === 'admin') 
                                {{ url('/admin/dashboard') }} 
                            @elseif(Auth::user()->role === 'owner') 
                                {{ url('/owner/dashboard') }} 
                            @elseif(Auth::user()->role === 'tenant') 
                                {{ url('/tenant/dashboard') }} 
                            @else 
                                {{ url('/dashboard') }} 
                            @endif
                        " style="color: #2C3E50;">
                            <i class="fa-solid fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="profileDropdown" data-bs-toggle="dropdown" style="color: #2C3E50;">
                            <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ url('/profile') }}"><i class="fa-solid fa-user-circle"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- Custom Navbar Styles -->
<style>
    /* Active link */
    .nav-link.active, .nav-link:hover {
        color: #F4A62A !important; /* Gold hover effect */
        border-bottom: 3px solid #F4A62A; /* Gold underline */
    }

    /* Dropdown menu styling */
    .dropdown-menu {
        background-color: #FFFFFF; /* White dropdown */
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Dropdown item hover */
    .dropdown-item:hover {
        background-color: #F4A62A;
        color: #FFFFFF !important;
    }
</style>




    <!-- Main Content -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Bingwa Homes. All Rights Reserved.</p>
    </footer>

    </body>
</html>
