@extends('layouts.app')

@section('title', 'Sesi Berakhir - Safa Marwa')

@section('content')
<div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 80vh; margin-top: 50px;">
    <div class="text-center animate-slide-up">
        <div class="error-illustration mb-5">
            <div class="glass-card d-inline-block p-5 rounded-circle shadow-premium bg-info-soft">
                <i class="fas fa-hourglass-end display-1 text-info animate-pulse-premium"></i>
            </div>
        </div>
        <h1 class="display-3 fw-900 text-info mb-3">419</h1>
        <h2 class="h3 fw-800 text-dark mb-4 uppercase letter-spacing-1">Sesi Perjalanan Berakhir</h2>
        <p class="text-muted fw-bold mb-5 mx-auto" style="max-width: 500px;">
            Keamanan Anda adalah prioritas kami. Karena tidak ada aktivitas dalam waktu lama, 
            sesi Anda telah kedaluwarsa demi melindungi data perjalanan Anda.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url()->previous() }}" class="btn btn-premium px-5 py-3 shadow-premium">
                <i class="fas fa-redo me-2"></i> PERBARUI HALAMAN
            </a>
            <a href="{{ url('/') }}" class="btn btn-outline-info px-5 py-3 rounded-pill fw-bold">
                MULAI LAGI
            </a>
        </div>
    </div>
</div>
@endsection
