@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - Safa Marwa')

@section('content')
<div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 80vh; margin-top: 50px;">
    <div class="text-center animate-slide-up">
        <div class="error-illustration mb-5">
            <div class="glass-card d-inline-block p-5 rounded-circle shadow-premium bg-primary-soft">
                <i class="fas fa-map-marked-alt display-1 text-primary animate-float"></i>
            </div>
        </div>
        <h1 class="display-3 fw-900 text-primary mb-3">404</h1>
        <h2 class="h3 fw-800 text-dark mb-4 uppercase letter-spacing-1">Petualangan Terhenti Sejenak</h2>
        <p class="text-muted fw-bold mb-5 mx-auto" style="max-width: 500px;">
            Maaf, halaman yang Anda cari tidak dapat kami temukan di peta perjalanan kami. 
            Mungkin rute ini sedang dalam pemeliharaan atau telah berpindah.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('/') }}" class="btn btn-premium px-5 py-3 shadow-premium">
                <i class="fas fa-home me-2"></i> KEMBALI KE BERANDA
            </a>
            <a href="{{ url('/help') }}" class="btn btn-outline-primary px-5 py-3 rounded-pill fw-bold">
                KONSULTASI BANTUAN
            </a>
        </div>
    </div>
</div>
@endsection
