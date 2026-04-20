@extends('layouts.admin')

@section('title', 'Admin Dashboard - Safa Marwa')

@section('content')
<div class="row g-4">
    <div class="col-12 mb-4 animate-slide-up">
        <h1 class="h2 fw-800 text-primary mb-2 uppercase letter-spacing-1">ADMIN <span class="text-primary-light">COMMAND CENTER</span></h1>
        <p class="text-muted fw-bold smaller uppercase">KONTROL PENUH OPERASIONAL & EKOSISTEM SAFA MARWA</p>
    </div>

    <!-- Stats Grid -->
    <div class="col-md-3 animate-slide-up" style="animation-delay: 0.1s">
        <div class="glass-card p-4 rounded-5 border-0 shadow-premium text-center h-100 transition-all">
            <div class="bg-primary-light bg-opacity-10 text-primary-light i-circle mx-auto mb-3" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 50%">
                <i class="fas fa-shopping-bag fs-3"></i>
            </div>
            <h3 class="h2 fw-900 text-primary mb-1">{{ $stats['total_bookings'] }}</h3>
            <p class="text-muted smaller fw-800 mb-0 uppercase">TOTAL TRANSAKSI</p>
        </div>
    </div>
    <!-- ... Rest of the stats grid ... -->
    <div class="col-md-3 animate-slide-up" style="animation-delay: 0.2s">
        <div class="glass-card p-4 rounded-5 border-0 shadow-premium text-center h-100 transition-all">
            <div class="bg-success bg-opacity-10 text-success i-circle mx-auto mb-3" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 50%">
                <i class="fas fa-wallet fs-3"></i>
            </div>
            <h3 class="h4 fw-900 text-primary mb-1">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</h3>
            <p class="text-muted smaller fw-800 mb-0 uppercase">REVENUE TOTAL</p>
        </div>
    </div>
    <div class="col-md-3 animate-slide-up" style="animation-delay: 0.3s">
        <div class="glass-card p-4 rounded-5 border-0 shadow-premium text-center h-100 transition-all">
            <div class="bg-amber bg-opacity-10 text-amber i-circle mx-auto mb-3" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 50%">
                <i class="fas fa-map-marked-alt fs-3"></i>
            </div>
            <h3 class="h2 fw-900 text-primary mb-1">{{ $stats['total_tours'] }}</h3>
            <p class="text-muted smaller fw-800 mb-0 uppercase">AKTIF TOUR</p>
        </div>
    </div>
    <div class="col-md-3 animate-slide-up" style="animation-delay: 0.4s">
        <div class="glass-card p-4 rounded-5 border-0 shadow-premium text-center h-100 transition-all">
            <div class="bg-info bg-opacity-10 text-info i-circle mx-auto mb-3" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 50%">
                <i class="fas fa-users-cog fs-3"></i>
            </div>
            <h3 class="h2 fw-900 text-primary mb-1">{{ $stats['total_users'] }}</h3>
            <p class="text-muted smaller fw-800 mb-0 uppercase">AUDIENS AKTIF</p>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="col-12 mt-4 animate-slide-up" style="animation-delay: 0.5s">
        <div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-xl overflow-hidden">
            <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom">
                <h2 class="h4 fw-800 text-primary mb-0 uppercase letter-spacing-1">TRANSAKSI TERBARU</h2>
                <a href="{{ url('/admin/bookings') }}" class="btn btn-premium btn-sm px-4 shadow-premium">
                    FULL REPORT <i class="fas fa-external-link-alt ms-2 smaller"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle custom-table-premium">
                    <thead>
                        <tr class="smaller text-muted uppercase fw-800 border-0">
                            <th class="border-0 pb-3">REFERENSI</th>
                            <th class="border-0 pb-3">PELANGGAN</th>
                            <th class="border-0 pb-3">RUTE PERJALANAN</th>
                            <th class="border-0 pb-3 text-center">STATUS AKTUAL</th>
                            <th class="border-0 pb-3 text-end">NAVIGASI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_bookings as $booking)
                            <tr class="transition-all">
                                <td class="fw-800 text-primary">{{ $booking->booking_code }}</td>
                                <td class="fw-bold text-dark small">{{ $booking->user_name }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-light text-primary-light border fw-800 px-2 rounded-3">{{ $booking->schedule->route->origin ?? 'N/A' }}</span>
                                        <i class="fas fa-long-arrow-alt-right opacity-25"></i>
                                        <span class="badge bg-light text-primary-light border fw-800 px-2 rounded-3">{{ $booking->schedule->route->destination ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $booking->status == 'paid' ? 'success' : 'warning' }}-light bg-opacity-10 text-{{ $booking->status == 'paid' ? 'success' : 'warning' }} rounded-pill px-3 py-2 smaller fw-800 border">
                                        <i class="fas fa-circle smaller me-1"></i> {{ strtoupper($booking->status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ url('/admin/bookings/' . $booking->id) }}" class="btn btn-white btn-sm rounded-3 border shadow-sm px-3 hover-primary transition-all">
                                        <i class="fas fa-eye me-2 small"></i> DETAIL
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

