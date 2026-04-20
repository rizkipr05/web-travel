@extends('layouts.app')

@section('title', $offer->title . ' - Safa Marwa Portal')

@section('content')
<div class="container py-5 mt-5">
    <div class="row g-5 animate-slide-up">
        <!-- Tour Gallery/Image -->
        <div class="col-lg-7">
            <div class="glass-card p-2 rounded-5 shadow-premium overflow-hidden">
                <img src="{{ \Illuminate\Support\Str::startsWith($offer->image_url, 'http') ? $offer->image_url : asset('storage/' . $offer->image_url) }}" 
                     class="img-fluid rounded-5 w-100" 
                     style="height: 500px; object-fit: cover;"
                     onerror="this.src='https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=2087&auto=format&fit=crop'">
            </div>
        </div>

        <!-- Tour Info -->
        <div class="col-lg-5">
            <div class="tour-info-card glass-card p-5 rounded-5 shadow-premium h-100">
                <span class="badge bg-primary-light bg-opacity-10 text-primary-light px-3 py-2 rounded-pill fw-bold mb-4 uppercase">
                    Paket Eksklusif
                </span>
                <h1 class="display-5 fw-800 text-primary mb-4">{{ $offer->title }}</h1>
                <p class="lead text-muted mb-5">
                    {{ $offer->description }}
                </p>

                <div class="price-box bg-light bg-opacity-50 p-4 rounded-4 border mb-5">
                    <span class="text-muted smaller fw-800 uppercase d-block mb-1">Investasi Perjalanan</span>
                    <h2 class="fw-900 text-primary-light mb-0">Rp {{ number_format($offer->price, 0, ',', '.') }}</h2>
                </div>

                <div class="d-grid gap-3">
                    <a href="#booking-section" class="btn btn-premium py-4 rounded-4 shadow-premium animate-pulse-premium">
                        <i class="fas fa-calendar-check me-2"></i> PESAN SEKARANG
                    </a>
                    <a href="{{ url('/tour') }}" class="btn btn-outline py-3 rounded-4">
                        Lihat Paket Lainnya
                    </a>
                </div>
                
                @if($offer->expiry_date)
                <div class="mt-4 text-center">
                    <span class="smaller text-danger fw-bold uppercase">
                        <i class="fas fa-hourglass-half me-1"></i> Penawaran berakhir dalam: {{ date('d M Y', strtotime($offer->expiry_date)) }}
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Available Schedules -->
    <section id="booking-section" class="py-5 mt-5 animate-slide-up">
        <div class="section-header-premium mb-5">
            <h2 class="text-primary fw-800">Pilih Jadwal Keberangkatan</h2>
            <p>Silakan pilih jadwal yang sesuai dengan rencana perjalanan Anda.</p>
        </div>

        <div class="row g-4">
            @forelse($schedules as $schedule)
            <div class="col-md-4">
                <div class="glass-card p-4 rounded-4 border transition-all hover-translate-up">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3">
                            <i class="fas fa-bus text-primary"></i>
                        </div>
                        <div>
                            <h6 class="fw-800 mb-0 text-primary">{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</h6>
                            <span class="smaller text-muted fw-bold">{{ $schedule->vehicle->name }}</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="fw-800 text-dark small mb-1">{{ date('d M Y', strtotime($schedule->departure_time)) }}</div>
                        <div class="smaller text-muted fw-bold uppercase"><i class="far fa-clock me-1"></i> {{ date('H:i', strtotime($schedule->departure_time)) }} WIB</div>
                    </div>
                    <a href="{{ url('/search?origin=' . $schedule->route->origin . '&destination=' . $schedule->route->destination . '&date=' . date('Y-m-d', strtotime($schedule->departure_time))) }}" class="btn btn-premium w-100 rounded-pill py-2">
                        Pesan Kursi
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fw-bold">Maaf, belum ada jadwal keberangkatan untuk paket ini.</p>
            </div>
            @endforelse
        </div>
    </section>
</div>
@endsection
