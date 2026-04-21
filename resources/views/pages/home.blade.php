@extends('layouts.app')

@section('title', 'Beranda - Safa Marwa Portal')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="hero-wrapper animate-slide-up">
        <header class="hero-main">
            <div class="row align-items-center w-100">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <span class="badge bg-primary-light bg-opacity-10 text-primary-light px-3 py-2 rounded-pill fw-bold mb-4">
                            Tingkatkan Perjalanan Anda
                        </span>
                        <h1 class="display-2 fw-800 text-primary mb-4" style="line-height: 1.1">
                            Rasakan Keajaiban <br> <span class="text-primary-light">Perjalanan!</span>
                        </h1>
                        <p class="lead text-muted mb-5 pe-lg-5">
                            Jelajahi dunia dengan kenyamanan tanpa batas. Safa Marwa hadir untuk memastikan setiap mil perjalanan Anda menjadi kenangan yang tak terlupakan.
                        </p>
                        <div class="hero-cta-box">
                            <a href="#search" class="btn btn-premium animate-pulse-premium">Pesan Sekarang</a>
                            <a href="{{ url('/tour') }}" class="btn btn-outline px-4">Lihat Paket</a>
                        </div>
                        
                        <div class="stats-container mt-5">
                            <div class="stat-item me-5">
                                <h2 class="fw-800">10+</h2>
                                <p>Pengalaman</p>
                            </div>
                            <div class="stat-item me-5">
                                <h2 class="fw-800">12K+</h2>
                                <p>Pelanggan</p>
                            </div>
                            <div class="stat-item">
                                <h2 class="fw-800">4.8</h2>
                                <p>Rating</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block position-relative">
                    <div class="hero-image-container animate-float">
                        <img src="{{ asset('img/hero_travel_car.png') }}" alt="Travel" class="img-fluid rounded-5 shadow-xl">
                        
                        <!-- Floating Glass Card -->
                        <div class="category-box glass-card position-absolute bottom-0 end-0 m-4 animate-slide-up">
                            <div class="user-avatars d-flex me-3">
                                <img src="https://i.pravatar.cc/40?u=1" class="rounded-circle border border-2 border-white ms-n2">
                                <img src="https://i.pravatar.cc/40?u=2" class="rounded-circle border border-2 border-white ms-n2" style="margin-left: -15px">
                                <img src="https://i.pravatar.cc/40?u=3" class="rounded-circle border border-2 border-white ms-n2" style="margin-left: -15px">
                            </div>
                            <div>
                                <p class="mb-0 fw-800 text-primary small">Pelanggan Aktif <i class="fas fa-arrow-right ms-1 small"></i></p>
                                <p class="mb-0 text-muted smaller">Bergabung Sekarang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <!-- Search Section -->
    <section id="search" class="search-container-premium animate-slide-up" style="margin-bottom: 8rem">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="fw-800 text-primary mb-0">Rencanakan Perjalanan</h3>
            </div>
            <div class="col-md-6 text-md-end">
                <span class="text-muted smaller fw-bold"><i class="fas fa-info-circle me-1"></i> Cari rute terbaik hari ini</span>
            </div>
        </div>
        <form action="{{ url('/search') }}" method="GET" class="row g-4">
            <div class="col-lg-3">
                <label class="form-label fw-bold text-primary small mb-3">Keberangkatan</label>
                <div class="position-relative">
                    <i class="fas fa-map-marker-alt position-absolute top-50 translate-middle-y ms-3 text-primary-light"></i>
                    <select name="origin" class="form-input-premium ps-5" required>
                        <option value="">Pilih Asal</option>
                        @foreach($origins as $origin)
                            <option value="{{ $origin }}">{{ $origin }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <label class="form-label fw-bold text-primary small mb-3">Kedatangan</label>
                <div class="position-relative">
                    <i class="fas fa-location-dot position-absolute top-50 translate-middle-y ms-3 text-primary-light"></i>
                    <select name="destination" class="form-input-premium ps-5" required>
                        <option value="">Pilih Tujuan</option>
                        @foreach($destinations as $dest)
                            <option value="{{ $dest }}">{{ $dest }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <label class="form-label fw-bold text-primary small mb-3">Jadwal Perjalanan</label>
                <div class="position-relative">
                    <i class="fas fa-calendar-alt position-absolute top-50 translate-middle-y ms-3 text-primary-light"></i>
                    <input type="date" name="date" class="form-input-premium ps-5" required value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-lg-3 d-flex align-items-end">
                <button type="submit" class="btn btn-premium w-100 py-3 rounded-4">
                    Cari Sekarang <i class="fas fa-search ms-2 small"></i>
                </button>
            </div>
        </form>
    </section>

    <!-- Popular Destinations -->
    <section class="py-5">
        <div class="section-header-premium">
            <h2 class="animate-slide-up">Destinasi Populer</h2>
            <p class="animate-slide-up">Bebaskan hasrat berkelana Anda bersama Safa Marwa. Pilihan rute terbaik untuk ibadah dan liburan Anda.</p>
        </div>
        
        <div class="row g-5">
            @foreach ($offers as $tour)
            <div class="col-xl-4 col-md-6 animate-slide-up">
                <div class="destination-card-premium">
                    <div class="card-img-wrapper">
                        <img src="{{ \Illuminate\Support\Str::startsWith($tour->image_url, 'http') ? $tour->image_url : asset('storage/' . $tour->image_url) }}" 
                             alt="{{ $tour->title }}"
                             onerror="this.src='https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=2087&auto=format&fit=crop'">
                        <div class="card-badge">
                            <i class="fas fa-tag me-1"></i> Promo
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h4 class="fw-800 text-primary mb-1">{{ $tour->title }}</h4>
                                <p class="text-muted small mb-0">{{ Str::limit($tour->description, 60) }}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <span class="text-muted smaller d-block">Mulai dari</span>
                                <span class="fw-800 text-primary-light h5 mb-0">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ url('/tour/' . $tour->id) }}" class="btn btn-outline btn-sm px-4">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Operational Schedule Section -->
    <section class="py-5 bg-light rounded-5 px-4 px-md-5 mb-5 animate-slide-up">
        <div class="section-header-premium mb-5">
            <h2>Jadwal Operasional</h2>
            <p>Pantau jadwal keberangkatan armada kami secara real-time untuk kemudahan rencana perjalanan Anda.</p>
        </div>

        <div class="table-responsive glass-card border-0 shadow-sm rounded-4 overflow-hidden">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="ps-4 py-3 border-0">Rute & Armada</th>
                        <th class="py-3 border-0">Keberangkatan</th>
                        <th class="py-3 border-0">Estimasi Tiba</th>
                        <th class="py-3 border-0 text-center">Status</th>
                        <th class="pe-4 py-3 border-0 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $schedule)
                    <tr>
                        <td class="ps-4 py-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-3">
                                    <i class="fas fa-bus text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="fw-800 mb-0 text-primary">{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</h6>
                                    <span class="smaller text-muted fw-bold">{{ $schedule->vehicle->name }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-800 text-dark small mb-1">{{ date('d M Y', strtotime($schedule->departure_time)) }}</div>
                            <div class="smaller text-muted fw-bold uppercase"><i class="far fa-clock me-1"></i> {{ date('H:i', strtotime($schedule->departure_time)) }} WIB</div>
                        </td>
                        <td>
                            @php
                                $arrival = date('Y-m-d H:i:s', strtotime($schedule->departure_time . ' + ' . $schedule->route->estimated_duration));
                            @endphp
                            <div class="fw-800 text-dark small mb-1">{{ date('d M Y', strtotime($arrival)) }}</div>
                            <div class="smaller text-muted fw-bold uppercase"><i class="far fa-clock me-1"></i> {{ date('H:i', strtotime($arrival)) }} WIB</div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary text-white rounded-pill px-3 py-2 smaller fw-800 border-0 shadow-sm">
                                <i class="fas fa-circle smaller me-1"></i> TERSEDIA
                            </span>
                        </td>
                        <td class="pe-4 text-end">
                            <a href="{{ url('/search?origin=' . $schedule->route->origin . '&destination=' . $schedule->route->destination . '&date=' . date('Y-m-d', strtotime($schedule->departure_time))) }}" class="btn btn-white btn-sm rounded-3 border shadow-sm px-3 hover-primary transition-all">
                                <i class="fas fa-ticket-alt me-1"></i> Pesan
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    <!-- WHY CHOOSE US -->
    <section class="py-5 mt-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="premium-gradient-bg p-5 rounded-5 shadow-xl animate-float">
                    <h2 class="display-5 fw-800 mb-4 text-white">Mengapa Memilih Kami?</h2>
                    <p class="lead opacity-75 mb-5">Kami memberikan layanan terbaik untuk memastikan kenyamanan ibadah dan perjalanan Anda.</p>
                    
                    <div class="d-flex gap-4 mb-4">
                        <div class="bg-white bg-opacity-10 p-3 rounded-4">
                            <i class="fas fa-shield-alt fs-2 text-white"></i>
                        </div>
                        <div>
                            <h5 class="text-white fw-bold">Keamanan Terjamin</h5>
                            <p class="text-white opacity-50 mb-0">Setiap transaksi dan perjalanan dilindungi asuransi terbaik.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-4">
                        <div class="bg-white bg-opacity-10 p-3 rounded-4">
                            <i class="fas fa-clock fs-2 text-white"></i>
                        </div>
                        <div>
                            <h5 class="text-white fw-bold">Layanan 24/7</h5>
                            <p class="text-white opacity-50 mb-0">Tim support kami siap membantu Anda kapan saja, di mana saja.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-lg-5">
                    <h2 class="display-6 fw-800 text-primary mb-4">Komitmen Kami Pada <span class="text-primary-light">Kenyamanan</span> Anda</h2>
                    <p class="text-muted mb-4">Safa Marwa lahir dari keinginan untuk memudahkan umat dalam menunaikan ibadah Umroh dan menjelajahi dunia dengan prinsip yang amanah.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-primary-light me-3"></i> <span class="fw-bold">Pembayaran Real-time (Midtrans)</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-primary-light me-3"></i> <span class="fw-bold">Manajemen Tiket Digital</span></li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-check-circle text-primary-light me-3"></i> <span class="fw-bold">Pilihan Paket Terlengkap</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Support FAB -->
    <a href="{{ url('/help') }}" class="support-fab animate-pulse-premium">
        <i class="fas fa-headset"></i>
    </a>
</div>
@endsection
