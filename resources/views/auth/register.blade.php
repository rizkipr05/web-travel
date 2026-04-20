@extends('layouts.app')

@section('title', 'Register - Safa Marwa')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10 animate-slide-up">
            <div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-premium mt-5">
                <div class="text-center mb-5">
                    <div class="bg-primary-light bg-opacity-10 text-primary-light i-circle mx-auto mb-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 80px; height: 80px; font-size: 2rem; border-radius: 50%">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h2 class="h3 fw-800 text-primary mb-1 uppercase letter-spacing-1">DAFTAR AKUN</h2>
                    <p class="text-muted fw-bold smaller uppercase text-center mx-auto" style="max-width: 400px;">BERGABUNGLAH DENGAN SAFA MARWA UNTUK PENGALAMAN PERJALANAN TERBAIK</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger smaller fw-bold border-0 rounded-4 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label smaller fw-800 text-muted uppercase mb-2">NAMA LENGKAP</label>
                            <div class="input-group-premium">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" class="form-control-premium" placeholder="Sesuai kartu identitas" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label smaller fw-800 text-muted uppercase mb-2">ALAMAT EMAIL</label>
                            <div class="input-group-premium">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control-premium" placeholder="name@example.com" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label smaller fw-800 text-muted uppercase mb-2">NOMOR TELEPON</label>
                            <div class="input-group-premium">
                                <i class="fas fa-phone"></i>
                                <input type="text" name="phone" class="form-control-premium" placeholder="Contoh: 08123456789" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label smaller fw-800 text-muted uppercase mb-2">ALAMAT LENGKAP</label>
                            <div class="input-group-premium">
                                <i class="fas fa-location-dot"></i>
                                <textarea name="address" class="form-control-premium" placeholder="Alamat lengkap tempat tinggal" rows="2" style="padding-top: 1.25rem;">{{ old('address') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label smaller fw-800 text-muted uppercase mb-2">KATA SANDI</label>
                            <div class="input-group-premium">
                                <i class="fas fa-key"></i>
                                <input type="password" name="password" class="form-control-premium" placeholder="Min. 8 karakter" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label smaller fw-800 text-muted uppercase mb-2">KONFIRMASI SANDI</label>
                            <div class="input-group-premium">
                                <i class="fas fa-shield-check"></i>
                                <input type="password" name="password_confirmation" class="form-control-premium" placeholder="Ulangi kata sandi" required>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <div class="d-grid gap-3">
                                <button type="submit" class="btn btn-premium py-3 shadow-premium">
                                    BUAT AKUN SAYA
                                </button>
                                <p class="text-center smaller text-muted fw-bold">SUDAH PUNYA AKUN? <a href="{{ url('/login') }}" class="text-primary-light text-decoration-none ms-2">MASUK DI SINI</a></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
