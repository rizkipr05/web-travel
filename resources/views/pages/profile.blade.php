@extends('layouts.app')

@section('title', 'Profil Saya - Safa Marwa Portal')

@section('content')
<div class="container py-5" style="margin-top: 100px">
    <div class="row g-5 justify-content-center">
        <div class="col-lg-4 animate-slide-up">
            <div class="glass-card p-4 rounded-5 text-center shadow-lg border-0 overflow-hidden">
                <div class="avatar-wrapper mb-4 position-relative">
                    <div class="bg-primary-light bg-opacity-10 text-primary-light i-circle mx-auto d-flex align-items-center justify-content-center shadow-premium" style="width: 140px; height: 140px; font-size: 4rem; border-radius: 50%">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
                <h3 class="h4 fw-800 text-primary mb-1 uppercase letter-spacing-1">{{ $user->name }}</h3>
                <p class="text-muted smaller fw-bold mb-4">{{ $user->email }}</p>
                
                <div class="row g-2">
                    <div class="col-6">
                        <div class="bg-light bg-opacity-50 p-3 rounded-4 text-center border">
                            <span class="d-block text-muted smaller fw-800 mb-1 uppercase">MEMBER SEJAK</span>
                            <span class="small fw-800 text-primary">{{ $user->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light bg-opacity-50 p-3 rounded-4 text-center border">
                            <span class="d-block text-muted smaller fw-800 mb-1 uppercase">PESANAN</span>
                            <span class="small fw-800 text-primary-light">{{ $user->bookings_count ?? 0 }} TRIP</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 animate-slide-up" style="animation-delay: 0.1s">
            <div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-lg">
                <div class="mb-5 pb-3 border-bottom d-flex align-items-center gap-3">
                     <i class="fas fa-sliders-h text-primary"></i>
                     <h4 class="fw-800 text-primary mb-0 uppercase letter-spacing-1">INFORMASI AKUN</h4>
                </div>
                
                <form action="{{ url('/profile/update') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label-premium">NAMA LENGKAP</label>
                            <div class="input-group-premium">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" class="form-control-premium" value="{{ $user->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-premium">ALAMAT EMAIL</label>
                            <div class="input-group-premium opacity-75">
                                <i class="fas fa-envelope"></i>
                                <input type="email" class="form-control-premium bg-light" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-premium">NOMOR TELEPON</label>
                            <div class="input-group-premium">
                                <i class="fas fa-phone"></i>
                                <input type="tel" name="phone" class="form-control-premium" value="{{ $user->phone }}" placeholder="+62...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label-premium">ALAMAT LENGKAP</label>
                            <div class="input-group-premium align-items-start">
                                <i class="fas fa-map-marker-alt mt-3"></i>
                                <textarea name="address" class="form-control-premium" rows="3">{{ $user->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-premium px-5 py-3 shadow-premium">
                                <i class="fas fa-save me-2"></i> SIMPAN PERUBAHAN
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-lg mt-4 border-start border-4 border-danger">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4">
                    <div>
                        <h4 class="h5 fw-800 text-danger mb-1 uppercase">KEAMANAN</h4>
                        <p class="smaller text-muted mb-0 fw-bold">Ganti kata sandi secara berkala untuk menjaga keamanan akun.</p>
                    </div>
                    <a href="{{ url('/profile/password') }}" class="btn btn-outline-danger px-4 rounded-pill fw-bold btn-sm">
                        <i class="fas fa-lock me-2"></i> UBAH PASSWORD
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
