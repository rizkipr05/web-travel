@extends('layouts.app')

@section('title', 'Kesalahan Server - Safa Marwa')

@section('content')
<div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 80vh; margin-top: 50px;">
    <div class="text-center animate-slide-up">
        <div class="error-illustration mb-5">
            <div class="glass-card d-inline-block p-5 rounded-circle shadow-premium bg-danger-soft">
                <i class="fas fa-engine-warning display-1 text-danger animate-pulse-premium"></i>
            </div>
        </div>
        <h1 class="display-3 fw-900 text-danger mb-3">500</h1>
        <h2 class="h3 fw-800 text-dark mb-4 uppercase letter-spacing-1">Gangguan Teknis Terdeteksi</h2>
        <p class="text-muted fw-bold mb-5 mx-auto" style="max-width: 500px;">
            Sistem kami sedang mengalami kendala teknis yang tidak terduga. 
            Tim teknisi kami telah diberitahu dan sedang bekerja keras untuk memulihkan rute Anda.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <button onclick="window.location.reload()" class="btn btn-premium px-5 py-3 shadow-premium">
                <i class="fas fa-sync me-2"></i> COBA LAGI
            </a>
            <a href="{{ url('/help') }}" class="btn btn-outline-danger px-5 py-3 rounded-pill fw-bold">
                LAPORKAN MASALAH
            </a>
        </div>
    </div>
</div>
@endsection
