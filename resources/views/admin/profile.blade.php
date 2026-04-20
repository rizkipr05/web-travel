@extends('layouts.admin')

@section('title', 'Admin Profile - Safa Marwa Admin')

@section('content')
<div class="mb-5 animate-slide-up">
    <h1 class="h2 fw-800 text-primary mb-2 uppercase letter-spacing-1">ADMINISTRATIVE <span class="text-primary-light">PROFILE</span></h1>
    <p class="text-muted fw-bold smaller uppercase">KELOLA IDENTITAS & OTORISASI AKSES SISTEM</p>
</div>

<div class="row g-4 justify-content-center">
    <div class="col-lg-4 animate-slide-up" style="animation-delay: 0.1s">
        <!-- ... Profile Card ... -->
        <div class="glass-card p-4 p-md-5 rounded-5 text-center shadow-premium border-0 bg-primary bg-opacity-5">
            <div class="avatar-wrapper mb-4 position-relative d-inline-block">
                <div class="bg-white text-primary rounded-circle mx-auto d-flex align-items-center justify-content-center shadow-premium border border-primary-light border-opacity-25" style="width: 160px; height: 160px; font-size: 4rem;">
                    <i class="fas fa-user-shield opacity-75"></i>
                </div>
                <div class="position-absolute bottom-0 end-0 bg-success p-2 rounded-circle border border-white" style="width: 25px; height: 25px;"></div>
            </div>
            <h3 class="h4 fw-800 text-primary mb-1 uppercase">{{ $user->name ?? 'Admin' }}</h3>
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-4 py-2 mt-2 border fw-800 smaller">SYSTEM OVERSEER</span>
            
            <div class="mt-5 pt-4 border-top border-dashed">
                <div class="d-flex justify-content-between smaller fw-800 text-muted uppercase mb-2">
                    <span>SINCE</span>
                    <span class="text-dark">{{ isset($user->created_at) ? $user->created_at->format('M Y') : 'N/A' }}</span>
                </div>
                <div class="d-flex justify-content-between smaller fw-800 text-muted uppercase">
                    <span>ACCESS</span>
                    <span class="text-success">RESTRICTED</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 animate-slide-up" style="animation-delay: 0.2s">
        <div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-xl overflow-hidden">
            <form action="{{ url('/profile/update') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-12 mb-3">
                        <h5 class="fw-800 text-primary border-bottom pb-2 uppercase letter-spacing-1">IDENTITAS PERSONAL</h5>
                    </div>
                    <div class="col-12">
                        <label class="form-label smaller fw-800 text-muted uppercase mb-2">NAMA LENGKAP ADMINISTRATOR</label>
                        <input type="text" name="name" class="form-control form-control-lg bg-light border-0 rounded-4 px-4 fw-bold" value="{{ $user->name ?? '' }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label smaller fw-800 text-muted uppercase mb-2">EMAIL SISTEM</label>
                        <input type="email" class="form-control form-control-lg bg-light border-0 rounded-4 px-4 fw-bold opacity-50" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label smaller fw-800 text-muted uppercase mb-2">TELEPON DARURAT</label>
                        <input type="tel" name="phone" class="form-control form-control-lg bg-light border-0 rounded-4 px-4 fw-bold" value="{{ $user->phone ?? '' }}">
                    </div>
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-premium px-5 py-3 shadow-premium">
                            VERIFIKASI & SIMPAN PERUBAHAN
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-premium mt-4 bg-amber bg-opacity-5">
            <div class="d-flex align-items-center gap-3 mb-3">
                <i class="fas fa-lock text-amber"></i>
                <h4 class="h6 fw-800 text-dark mb-0 uppercase">KONFIGURASI KEAMANAN</h4>
            </div>
            <p class="smaller text-muted mb-4 fw-bold">Update kredensial akses Anda secara berkala untuk menjaga integritas sistem Safa Marwa.</p>
            <a href="{{ url('/profile/password') }}" class="btn btn-outline-dark btn-sm px-4 py-2 rounded-pill fw-800 uppercase smaller">
                UPDATE PASSWORD <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>
@endsection

