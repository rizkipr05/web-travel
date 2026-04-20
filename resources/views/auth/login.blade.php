@extends('layouts.app')

@section('title', 'Login - Safa Marwa')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 animate-slide-up">
            <div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-premium mt-5">
                <div class="text-center mb-5">
                    <div class="bg-primary-light bg-opacity-10 text-primary-light i-circle mx-auto mb-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 80px; height: 80px; font-size: 2rem; border-radius: 50%">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h2 class="h3 fw-800 text-primary mb-1 uppercase letter-spacing-1">SELAMAT DATANG</h2>
                    <p class="text-muted fw-bold smaller uppercase">MASUK KE AKUN SAFA MARWA ANDA</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @if(session('error'))
                        <div class="alert alert-danger smaller fw-bold border-0 rounded-4 mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger smaller fw-bold border-0 rounded-4 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-4">
                        <label class="form-label smaller fw-800 text-muted uppercase mb-2">ALAMAT EMAIL</label>
                        <div class="input-group-premium">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" class="form-control-premium" placeholder="Masukkan alamat email" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label smaller fw-800 text-muted uppercase mb-2">KATA SANDI</label>
                        <div class="input-group-premium">
                            <i class="fas fa-key"></i>
                            <input type="password" name="password" class="form-control-premium" placeholder="Min. 8 karakter" required>
                        </div>
                    </div>
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input border-primary-light" id="remember" name="remember">
                            <label class="form-check-label smaller fw-bold text-muted" for="remember">Ingat Saya</label>
                        </div>
                        <a href="{{ url('/password/reset') }}" class="smaller fw-bold text-primary-light text-decoration-none">Lupa Sandi?</a>
                    </div>
                    <div class="d-grid gap-3 pt-3">
                        <button type="submit" class="btn btn-premium py-3 shadow-premium">
                            LOGIN SEKARANG
                        </button>
                        <div class="text-center">
                            <span class="smaller text-muted fw-bold uppercase">BELUM PUNYA AKUN?</span>
                            <a href="{{ url('/register') }}" class="d-block mt-2 fw-800 text-primary-light text-decoration-none">DAFTAR AKUN BARU <i class="fas fa-chevron-right smaller ms-1"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
