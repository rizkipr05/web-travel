@extends('layouts.app')

@section('title', 'Pusat Bantuan - Safa Marwa Portal')

@section('content')
<div class="container py-5" style="margin-top: 100px">
    <div class="text-center mb-5 animate-slide-up">
        <h1 class="h1 fw-800 text-primary mb-3 uppercase letter-spacing-2">BANTUAN & <span class="text-primary-light">DUKUNGAN</span></h1>
        <p class="lead text-muted fw-bold smaller uppercase letter-spacing-1">SOLUSI TERPADU UNTUK SETIAP PERJALANAN ANDA</p>
    </div>

    <div class="row g-5">
        <div class="col-lg-8 animate-slide-up">
            <div class="glass-card p-4 p-md-5 rounded-5 shadow-premium border-0">
                <div class="d-flex align-items-center gap-3 mb-5 border-bottom pb-3">
                    <i class="fas fa-question-circle text-primary fs-3"></i>
                    <h4 class="fw-800 text-primary mb-0 uppercase letter-spacing-1">PERTANYAAN POPULER (FAQ)</h4>
                </div>
                
                <div class="accordion accordion-flush custom-accordion-premium" id="helpAccordion">
                    <div class="accordion-item bg-transparent mb-4 border rounded-5 overflow-hidden shadow-sm transition-all hover-border-primary">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-800 text-primary py-4 px-4 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#q1">
                                Bagaimana cara melakukan reservasi kursi premium?
                            </button>
                        </h2>
                        <div id="q1" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body text-muted fw-bold smaller bg-light bg-opacity-30 px-4 py-4 border-top">
                                Anda dapat memilih rute di halaman utama, kemudian sistem akan mengarahkan ke pemilihan jadwal dan unit armada. Pilih nomor kursi pada peta interaktif yang tersedia sebelum melakukan pembayaran.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item bg-transparent mb-4 border rounded-5 overflow-hidden shadow-sm transition-all hover-border-primary">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-800 text-primary py-4 px-4 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#q2">
                                Apakah pembayaran saya terjamin keamanannya?
                            </button>
                        </h2>
                        <div id="q2" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body text-muted fw-bold smaller bg-light bg-opacity-30 px-4 py-4 border-top">
                                Ya, kami menggunakan Midtrans sebagai payment gateway terenkripsi AES-256 yang mendukung berbagai metode mulai dari Virtual Account, QRIS, hingga Kartu Kredit.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent mb-4 border rounded-5 overflow-hidden shadow-sm transition-all hover-border-primary">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent fw-800 text-primary py-4 px-4 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#q3">
                                Dimana saya dapat mengakses e-ticket perjalanan?
                            </button>
                        </h2>
                        <div id="q3" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                            <div class="accordion-body text-muted fw-bold smaller bg-light bg-opacity-30 px-4 py-4 border-top">
                                E-ticket akan keluar otomatis setelah verifikasi pembayaran berhasil. Anda dapat menemukan seluruh manifest di menu <a href="{{ url('/my-bookings') }}" class="text-primary-light">Pesanan Saya</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 animate-slide-up" style="animation-delay: 0.2s">
            <div class="glass-card p-4 p-md-5 rounded-5 bg-primary text-white shadow-premium border-0 overflow-hidden position-relative">
                <i class="fas fa-headset fs-1 mb-4 opacity-25 position-absolute top-0 end-0 m-4"></i>
                <h3 class="h4 fw-800 mb-4 uppercase letter-spacing-1">VIP CONCIERGE</h3>
                <p class="opacity-75 mb-5 fw-bold smaller">Dukungan personal 24/7 untuk memastikan setiap detail perjalanan Anda terencana dengan sempurna.</p>
                
                <div class="d-grid gap-3">
                    <a href="https://wa.me/628123456789" class="btn btn-white w-100 py-3 text-primary fw-800 shadow-sm transition-all hover-translate-y">
                        <i class="fab fa-whatsapp me-2"></i> WHATSAPP CHAT
                    </a>
                    <a href="mailto:support@safamarwa.com" class="btn btn-outline-white w-100 py-3 fw-800 transition-all hover-bg-white hover-text-primary">
                        <i class="fas fa-envelope me-2"></i> EMAIL SUPPORT
                    </a>
                </div>
            </div>
            
            <div class="glass-card p-4 rounded-5 mt-4 text-center border-dashed border-primary-light border-opacity-25 bg-primary-soft">
                 <p class="smaller text-muted mb-0 fw-800 uppercase letter-spacing-1"><i class="far fa-clock me-1"></i> FULL-SERVICE OPERATIONAL 24/7</p>
            </div>
        </div>
    </div>
</div>
@endsection
