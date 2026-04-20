@extends('layouts.app')

@section('title', 'Pesanan Saya - Safa Marwa Portal')

@section('content')
<div class="container py-5" style="margin-top: 100px">
    <div class="mb-5 animate-slide-up">
        <h1 class="h2 fw-800 text-primary mb-2 uppercase letter-spacing-1">RIWAYAT PERJALANAN</h1>
        <p class="text-muted fw-bold smaller uppercase">Kelola dan pantau pesanan aktif maupun riwayat Anda.</p>
    </div>

    <div class="row">
        <div class="col-12">
            @forelse($bookings as $booking)
                <div class="glass-card p-4 rounded-5 mb-4 border-0 shadow-premium overflow-hidden position-relative animate-slide-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <div class="row align-items-center g-4">
                        <div class="col-md-2">
                            <span class="d-block text-muted smaller fw-800 mb-1 uppercase">KODE BOOKING</span>
                            <span class="h5 fw-800 text-primary mb-0">{{ $booking->booking_code }}</span>
                        </div>
                        <div class="col-md-3">
                            <span class="d-block text-muted smaller fw-800 mb-1 uppercase">DARI & TUJUAN</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-800 text-primary uppercase small">{{ $booking->schedule->route->origin ?? 'N/A' }}</span>
                                <i class="fas fa-long-arrow-right text-primary-light"></i>
                                <span class="fw-800 text-primary uppercase small">{{ $booking->schedule->route->destination ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <span class="d-block text-muted smaller fw-800 mb-1 uppercase">KEBERANGKATAN</span>
                            <span class="small fw-800 text-dark">{{ date('d M Y, H:i', strtotime($booking->schedule->departure_time)) }}</span>
                        </div>
                        <div class="col-md-2">
                            <span class="d-block text-muted smaller fw-800 mb-1 uppercase">STATUS</span>
                            @php
                                $status_classes = [
                                    'pending' => 'bg-warning-light bg-opacity-10 text-warning',
                                    'completed' => 'bg-success bg-opacity-10 text-success',
                                    'cancelled' => 'bg-danger bg-opacity-10 text-danger',
                                    'paid' => 'bg-info bg-opacity-10 text-info'
                                ];
                                $status_labels = [
                                    'pending' => 'PENDING',
                                    'completed' => 'SELESAI',
                                    'cancelled' => 'DIBATALKAN',
                                    'paid' => 'DIBAYAR'
                                ];
                            @endphp
                            <span class="badge {{ $status_classes[$booking->status] ?? 'bg-secondary bg-opacity-10 text-secondary' }} px-3 py-2 rounded-pill smaller fw-800 border">
                                <i class="fas fa-circle smaller me-1"></i> {{ $status_labels[$booking->status] ?? $booking->status }}
                            </span>
                        </div>
                        <div class="col-md-3 text-md-end">
                            @if($booking->status == 'pending')
                                <a href="{{ url('/payment/' . $booking->id) }}" class="btn btn-premium btn-sm px-4">
                                    <i class="fas fa-credit-card me-2"></i> BAYAR SEKARANG
                                </a>
                            @else
                                <a href="{{ url('/ticket/' . $booking->id) }}" class="btn btn-outline-primary btn-sm px-4 rounded-pill fw-bold">
                                    <i class="fas fa-ticket-alt me-2"></i> LIHAT TIKET
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 animate-slide-up">
                    <div class="glass-card p-5 rounded-5 border-dashed">
                        <div class="bg-light i-circle mx-auto mb-4" style="width: 100px; height: 100px; font-size: 3rem; display: flex; align-items: center; justify-content: center; border-radius: 50%">
                            <i class="fas fa-ticket-alt text-muted opacity-25"></i>
                        </div>
                        <h3 class="h4 fw-800 text-primary">Belum ada pesanan</h3>
                        <p class="text-muted fw-bold mb-4">Jelajahi rute kami dan mulailah perjalanan Anda hari ini.</p>
                        <a href="{{ url('/') }}" class="btn btn-premium px-5 py-3 shadow-premium">
                             MENCARI PERJALANAN <i class="fas fa-search ms-2"></i>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
