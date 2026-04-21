<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Safa Marwa')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        :root {
            --sidebar-width: 280px;
        }

        body {
            background-color: #f8fafc;
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--primary);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .admin-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 2rem;
            text-align: center;
        }

        .sidebar-menu {
            flex-grow: 1;
            padding: 0 1.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.7);
            border-radius: 1rem;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 600;
            text-decoration: none;
        }

        .sidebar-link:hover, .sidebar-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar-link.active {
            background: var(--primary-light);
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
        }

        .sidebar-link i {
            width: 20px;
            text-align: center;
        }

        .logout-section {
            padding: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                left: calc(-1 * var(--sidebar-width));
            }
            .admin-sidebar.show {
                left: 0;
            }
            .admin-content {
                margin-left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <div class="admin-sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-800 uppercase mb-0 letter-spacing-1">SAFA <span class="text-primary-light">MARWA</span></h4>
            <p class="smaller fw-bold text-white-50 mt-1 uppercase">ADMIN PORTAL</p>
        </div>

        <div class="sidebar-menu">
            <a href="{{ url('/admin/dashboard') }}" class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
            <a href="{{ url('/admin/tours') }}" class="sidebar-link {{ Request::is('admin/tours*') ? 'active' : '' }}">
                <i class="fas fa-suitcase-rolling"></i> <span>Paket Tour</span>
            </a>
            <a href="{{ url('/admin/schedules') }}" class="sidebar-link {{ Request::is('admin/schedules*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> <span>Jadwal</span>
            </a>
            <a href="{{ url('/admin/bookings') }}" class="sidebar-link {{ Request::is('admin/bookings*') ? 'active' : '' }}">
                <i class="fas fa-shopping-bag"></i> <span>Transaksi</span>
            </a>
            <a href="{{ url('/admin/profile') }}" class="sidebar-link {{ Request::is('admin/profile*') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i> <span>Profil Saya</span>
            </a>
        </div>

        <div class="logout-section">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start">
                    <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>

    <div class="admin-content">
        <!-- Mobile Toggle -->
        <button class="btn d-lg-none mb-4" onclick="document.getElementById('sidebar').classList.toggle('show')">
            <i class="fas fa-bars"></i>
        </button>

        @if(session('success'))
            <div class="alert alert-success alert-premium border-0 shadow-sm rounded-4 mb-4 animate-slide-up">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-premium border-0 shadow-sm rounded-4 mb-4 animate-slide-up">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>
