@extends('layouts.app')

@section('title', 'E-Tiket - Safa Marwa')

@section('styles')
<style>
    .boarding-pass-wrapper {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        border-radius: 2.5rem;
        overflow: hidden;
        box-shadow: var(--shadow-xl);
        display: flex;
        position: relative;
    }
    .pass-sidebar {
        background: var(--primary);
        color: white;
        padding: 3rem 2rem;
        width: 100px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        border-right: 1px solid rgba(255,255,255,0.1);
    }
    .pass-content {
        padding: 4rem;
        flex-grow: 1;
        background: radial-gradient(circle at 100% 0%, rgba(59, 130, 246, 0.03) 0%, transparent 50%);
    }
    .vertical-text {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        font-weight: 800;
        letter-spacing: 0.5em;
        opacity: 0.3;
        font-size: 0.8rem;
    }
    .pass-divider {
        border-right: 2px dashed var(--border);
        position: relative;
        margin: 0 1rem;
    }
    .pass-divider::before, .pass-divider::after {
        content: '';
        position: absolute;
        width: 40px;
        height: 40px;
        background: var(--bg-soft);
        border-radius: 50%;
        left: -21px;
    }
    .pass-divider::before { top: -20px; }
    .pass-divider::after { bottom: -20px; }
    
    .qr-premium {
        width: 140px;
        height: 140px;
        padding: 10px;
        border: 2px solid var(--border);
        border-radius: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
    }

    @media print {
        @page { margin: 0; }
        .navbar, .footer, .btn-print-wrapper { display: none !important; }
        body { background: white !important; padding: 0 !important; }
        .boarding-pass-wrapper { box-shadow: none; border: 2px solid #eee; width: 100%; margin: 0; border-radius: 0; }
        .pass-divider::before, .pass-divider::after { display: none; }
    }
</style>
@endsection

@section('content')
<div class="container py-5" style="margin-top: 100px">
    <div class="mb-5 text-center btn-print-wrapper animate-slide-up">
        <button onclick="window.print()" class="btn btn-premium px-5 py-3 shadow-premium">
            <i class="fas fa-print me-2"></i> CETAK TIKET ELEKTRONIK
        </button>
        <p class="text-muted smaller mt-3 fw-bold">Simpan sebagai PDF atau cetak untuk bukti fisik</p>
    </div>

    <div class="boarding-pass-wrapper animate-slide-up">
        <!-- Sidebar -->
        <div class="pass-sidebar d-none d-lg-flex">
            <i class="fas fa-shuttle-van fs-3 opacity-50"></i>
            <div class="vertical-text uppercase">SAFA MARWA OFFICIAL TICKET</div>
            <i class="fas fa-barcode fs-3 opacity-50"></i>
        </div>

        <!-- Main Content -->
        <div class="pass-content">
            <div class="d-flex justify-content-between align-items-center mb-5 pb-4 border-bottom">
                <div>
                    <h3 class="fw-800 text-primary mb-0 letter-spacing-1">SAFA MARWA</h3>
                    <span class="text-primary-light fw-bold smaller">PREMIUM TRAVEL PARTNER</span>
                </div>
                <div class="text-end">
                    <span class="d-block text-muted smaller fw-bold mb-1 uppercase">BOOKING REF</span>
                    <span class="h4 fw-800 text-primary mb-0">{{ $booking->booking_code ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="row g-5 align-items-center mb-5">
                <div class="col-lg-8">
                    <div class="row g-4">
                        <div class="col-12 mb-4">
                            <span class="text-muted smaller fw-bold d-block mb-2 uppercase">NAMA PENUMPANG</span>
                            <h2 class="fw-800 text-primary mb-0">{{ $booking->customer_name ?? 'N/A' }}</h2>
                        </div>
                        <div class="col-6">
                            <span class="text-muted smaller fw-bold d-block mb-1 uppercase">DARI</span>
                            <span class="h5 fw-800 text-primary mb-0 uppercase">{{ $booking->schedule->route->origin ?? 'Unknown' }}</span>
                        </div>
                        <div class="col-6 text-end text-lg-start">
                            <span class="text-muted smaller fw-bold d-block mb-1 uppercase">TUJUAN</span>
                            <span class="h5 fw-800 text-primary mb-0 uppercase">{{ $booking->schedule->route->destination ?? 'Unknown' }}</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted smaller fw-bold d-block mb-1 uppercase">TANGGAL</span>
                            <span class="h5 fw-800 text-primary mb-0">{{ date('d M Y', strtotime($booking->schedule->departure_time)) }}</span>
                        </div>
                        <div class="col-6 text-end text-lg-start">
                            <span class="text-muted smaller fw-bold d-block mb-1 uppercase">JAM</span>
                            <span class="h5 fw-800 text-primary mb-0 text-primary-light">{{ date('H:i', strtotime($booking->schedule->departure_time)) }} WIB</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="qr-premium d-inline-flex mx-auto border-dashed">
                        <i class="fas fa-qrcode fa-5x text-primary opacity-25"></i>
                    </div>
                    <div class="mt-4">
                        <span class="text-muted smaller fw-bold d-block mb-1 uppercase">NOMOR KURSI</span>
                        <div class="d-flex justify-content-center justify-content-lg-end gap-2">
                             @foreach($booking->bookedSeats as $seat)
                                <span class="h2 fw-800 text-primary-light mb-0">{{ $seat->seat_number }}</span>
                                @if(!$loop->last) <span class="h2 text-muted fw-light">,</span> @endif
                             @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-light p-4 rounded-4 border-dashed d-flex flex-column flex-md-row justify-content-between align-items-center gap-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <span class="smaller fw-bold text-muted d-block opacity-50 mb-1 uppercase">STATUS PEMBAYARAN</span>
                        <span class="h6 fw-800 text-success mb-0">LUNAS / PAID IN FULL</span>
                    </div>
                </div>
                <div class="text-md-end">
                    <p class="smaller text-muted mb-0 fw-bold">Harap lapor ke kru 15 menit sebelum keberangkatan.</p>
                </div>
            </div>
            
            <div class="text-center mt-5 opacity-25">
                <p class="smaller fw-bold mb-0">TERIMA KASIH TELAH MEMILIH LAYANAN SAFA MARWA</p>
            </div>
        </div>
    </div>
</div>
@endsection
