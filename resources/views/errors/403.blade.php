@extends('layouts.app')

@section('title', 'Akses Dibatasi - Safa Marwa')

@section('content')
<div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 80vh; margin-top: 50px;">
    <div class="text-center animate-slide-up">
        <div class="error-illustration mb-5">
            <div class="glass-card d-inline-block p-5 rounded-circle shadow-premium bg-warning-soft">
                <i class="fas fa-user-shield display-1 text-warning"></i>
            </div>
        </div>
        <h1 class="display-3 fw-900 text-warning mb-3">403</h1>
        <h2 class="h3 fw-800 text-dark mb-4 uppercase letter-spacing-1">Akses Kelas Premium Dibatasi</h2>
        <p class="text-muted fw-bold mb-5 mx-auto" style="max-width: 500px;">
            Mohon maaf, Anda tidak memiliki izin untuk mengakses area ini. 
            Hanya penumpang dengan otorisasi khusus yang diperkenankan masuk ke rute ini.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ url('/') }}" class="btn btn-premium px-5 py-3 shadow-premium">
                <i class="fas fa-chevron-left me-2"></i> KEMBALI KE BERANDA
            </a>
            <a href="{{ url('/login') }}" class="btn btn-outline-warning px-5 py-3 rounded-pill fw-bold">
                MASUK KE AKUN
            </a>
        </div>
    </div>
</div>
@endsection
