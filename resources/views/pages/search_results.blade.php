@extends('layouts.app')

@section('title', 'Hasil Pencarian - Safa Marwa Portal')

@section('content')
<div class="container py-5" style="margin-top: 100px">
    <div class="d-flex align-items-center justify-content-between mb-5 animate-slide-up">
        <div>
            <a href="{{ url('/') }}" class="text-primary-light fw-bold text-decoration-none small">
                <i class="fas fa-arrow-left me-2"></i> UBAH PENCARIAN
            </a>
            <h1 class="display-4 fw-800 mt-3 text-primary">Jadwal <span class="text-primary-light">Tersedia</span></h1>
        </div>
        <div class="glass-card p-4 rounded-5 d-flex align-items-center gap-4 shadow-sm">
            <div class="text-center px-3">
                <p class="text-muted smaller fw-bold mb-1">TANGGAL</p>
                <p class="fw-800 text-primary mb-0">{{ date('D, d M Y', strtotime($date)) }}</p>
            </div>
            <div class="border-start opacity-10" style="height: 40px"></div>
            <div class="text-center px-3">
                <p class="text-muted smaller fw-bold mb-1">RUTE</p>
                <p class="fw-800 text-primary mb-0 uppercase">{{ $origin }} <i class="fas fa-plane mx-2 text-primary-light small"></i> {{ $destination }}</p>
            </div>
        </div>
    </div>

    @if($schedules->isEmpty())
        <div class="glass-card p-5 text-center rounded-5 animate-slide-up border-0 shadow-sm">
            <div class="bg-light p-4 rounded-circle d-inline-flex mb-4">
                <i class="fas fa-search fa-3x text-muted opacity-25"></i>
            </div>
            <h2 class="fw-800 text-primary mb-3">Perjalanan tidak ditemukan</h2>
            <p class="text-muted mb-4 px-lg-5">Kami tidak menemukan perjalanan yang sesuai dengan kriteria Anda. Coba sesuaikan tanggal atau rute Anda untuk melihat pilihan lainnya.</p>
            <a href="{{ url('/') }}" class="btn btn-premium px-5 py-3">Cari Lagi</a>
        </div>
    @else
        <div class="schedule-list d-flex flex-column gap-4">
            @foreach($schedules as $s)
                <div class="glass-card border-0 d-flex flex-column flex-lg-row overflow-hidden rounded-5 shadow-lg animate-slide-up">
                    <div class="bg-primary text-white d-flex flex-row flex-lg-column align-items-center justify-content-center px-5 py-4 py-lg-0">
                        <h2 class="display-6 fw-800 mb-0">{{ date('H:i', strtotime($s->departure_time)) }}</h2>
                        <span class="smaller fw-bold opacity-50 ms-3 ms-lg-0">KEBERANGKATAN</span>
                    </div>
                    <div class="flex-grow-1 p-4 p-lg-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                        <div class="info-content">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill fw-bold smaller mb-3 d-inline-block">ARMADA TERVERIFIKASI</span>
                            <h3 class="fw-800 text-primary mb-3">{{ $s->vehicle->name }}</h3>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-light text-muted fw-bold px-3 py-2 rounded-3"><i class="fas fa-snowflake me-2 text-primary-light"></i> AC</span>
                                <span class="badge bg-light text-muted fw-bold px-3 py-2 rounded-3"><i class="fas fa-wifi me-2 text-primary-light"></i> WiFi</span>
                                <span class="badge bg-light text-muted fw-bold px-3 py-2 rounded-3"><i class="fas fa-coffee me-2 text-primary-light"></i> Snack</span>
                            </div>
                        </div>
                        <div class="text-md-end ps-lg-5 border-lg-start border-light pt-4 pt-md-0 d-flex flex-column justify-content-between">
                            <div>
                                <p class="text-muted smaller fw-bold mb-1">HARGA PER KURSI</p>
                                <h2 class="fw-800 text-primary mb-3">Rp {{ number_format($s->route->price, 0, ',', '.') }}</h2>
                            </div>
                            <a href="{{ url('/booking/' . $s->id) }}" class="btn btn-premium w-100 py-3">Pilih Kursi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
