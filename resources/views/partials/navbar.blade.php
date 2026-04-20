<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand logo" href="{{ url('/') }}">
            <i class="fas fa-kaaba"></i>
            <span>SAFA MARWA</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ Request::is('tour*') ? 'active' : '' }}" href="{{ url('/tour') }}">Tur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ Request::is('help') ? 'active' : '' }}" href="{{ url('/help') }}">Bantuan</a>
                </li>
                <li class="nav-item ms-lg-2">
                    @auth
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle btn btn-outline btn-sm px-4" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-3">
                                <li><a class="dropdown-item rounded-3 mb-1" href="{{ url('/profile') }}"><i class="fas fa-user me-2 opacity-50"></i>Profil</a></li>
                                <li><a class="dropdown-item rounded-3 mb-1" href="{{ url('/my-bookings') }}"><i class="fas fa-ticket-alt me-2 opacity-50"></i>Pesanan Saya</a></li>
                                <li><hr class="dropdown-divider opacity-10"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item rounded-3 text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ url('/login') }}" class="btn btn-premium btn-sm px-5">Masuk</a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
