@extends('layouts.app')

@section('title', 'Tentang Kami - Safa Marwa Portal')

@section('content')
<div class="container py-5" style="margin-top: 100px">
    <div class="row align-items-center g-5">
        <div class="col-lg-6 animate-slide-up">
            <span class="badge bg-primary-light bg-opacity-10 text-primary-light px-3 py-2 rounded-pill fw-bold mb-4">
                Melayani Setulus Hati
            </span>
            <h1 class="display-3 fw-800 text-primary mb-4">Misi Kami Adalah <span class="text-primary-light">Kenyamanan</span> Anda</h1>
            <p class="lead text-muted mb-5">Safa Marwa adalah portal perjalanan yang berfokus pada kenyamanan dan kepercayaan pelanggan dalam merencanakan perjalanan ibadah maupun wisata dunia.</p>
            
            <div class="vision-mission d-flex flex-column gap-4">
                <div class="glass-card p-4 rounded-4 border-start border-4 border-primary-light">
                    <div class="d-flex gap-4 align-items-center">
                        <div class="bg-primary-light bg-opacity-10 text-primary-light p-3 rounded-4">
                            <i class="fas fa-eye fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-800 text-primary mb-1">Visi Kami</h5>
                            <p class="text-muted mb-0 small">Menjadi platform portal travel terdepan yang menghubungkan setiap pejalan dengan pengalaman yang tak terlupakan.</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-4 rounded-4 border-start border-4 border-accent">
                    <div class="d-flex gap-4 align-items-center">
                        <div class="bg-accent bg-opacity-10 text-accent p-3 rounded-4">
                            <i class="fas fa-rocket fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-800 text-primary mb-1">Misi Kami</h5>
                            <p class="text-muted mb-0 small">Menyediakan layanan pemesanan tiket dan paket wisata yang mudah, transparan, dan dapat diandalkan secara real-time.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 animate-float">
            <div class="position-relative">
                <div class="bg-primary-light position-absolute top-100 start-0 translate-middle p-5 rounded-circle opacity-10" style="width: 300px; height: 300px"></div>
                <img src="{{ asset('img/about_premium.png') }}" class="img-fluid rounded-5 shadow-xl relative-top" alt="About Safa Marwa">
                <div class="glass-card p-4 rounded-4 position-absolute bottom-0 start-0 m-4 shadow-xl">
                    <h2 class="display-4 fw-800 text-primary-light mb-0">10+</h2>
                    <p class="text-primary fw-800 mb-0">Tahun Pengalaman</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
