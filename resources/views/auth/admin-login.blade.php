@extends('layouts.app')

@section('title', 'Admin Login - Safa Marwa')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 animate-slide-up">
            <div class="admin-card p-4 p-md-5 rounded-5 border-0 shadow-premium mt-5" style="border-top: 4px solid var(--primary) !important;">
                <div class="text-center mb-5">
                    <div class="bg-primary bg-opacity-10 text-primary i-circle mx-auto mb-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 80px; height: 80px; font-size: 2rem; border-radius: 50%">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h2 class="h3 fw-800 text-primary mb-1 uppercase letter-spacing-1">ADMIN PORTAL</h2>
                    <p class="text-muted fw-bold smaller uppercase">MASUK KE PANEL ADMINISTRATOR</p>
                </div>

                <form method="POST" action="{{ route('admin.login') }}">
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
                    
                    <div class="mb-4">
                        <label class="form-label smaller fw-800 text-muted uppercase mb-2">EMAIL ADMIN</label>
                        <div class="input-group-premium">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" class="form-control-premium" placeholder="admin@safamarwa.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label smaller fw-800 text-muted uppercase mb-2">KATA SANDI</label>
                        <div class="input-group-premium">
                            <i class="fas fa-key"></i>
                            <input type="password" name="password" class="form-control-premium" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input border-primary" id="remember" name="remember">
                            <label class="form-check-label smaller fw-bold text-muted" for="remember">Ingat Saya</label>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-3 pt-3">
                        <button type="submit" class="btn btn-premium py-3 shadow-premium" style="background: var(--primary);">
                            LOGIN ADMINISTRATOR
                        </button>
                        <div class="text-center mt-3">
                            <a href="{{ url('/login') }}" class="smaller fw-bold text-muted text-decoration-none"><i class="fas fa-arrow-left me-1"></i> KEMBALI KE LOGIN USER</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
