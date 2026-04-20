@extends('layouts.app')

@section('title', 'Paket Tur - Safa Marwa Portal')

@section('content')
<div class="container py-5 mt-5">
    <div class="text-center mb-5">
        <h1 class="display-3 fw-bold text-primary">Paket Tur Eksklusif</h1>
        <p class="lead text-muted">Temukan perjalanan impian Anda dengan penawaran terbaik kami.</p>
    </div>

    <div class="row g-4">
        @forelse($offers as $offer)
            <div class="col-lg-4 col-md-6">
                <div class="offer-card glass-card h-100 rounded-5 overflow-hidden">
                    <div class="position-relative">
                        <img src="{{ \Illuminate\Support\Str::startsWith($offer->image_url, 'http') ? $offer->image_url : asset('storage/' . $offer->image_url) }}" 
                             class="card-img-top" 
                             alt="{{ $offer->title }}"
                             style="height: 250px; object-fit: cover;"
                             onerror="this.src='https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=2087&auto=format&fit=crop'">
                        @if($offer->expiry_date)
                            <div class="promo-badge">BERAKHIR: {{ date('d M', strtotime($offer->expiry_date)) }}</div>
                        @endif
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h3 class="h4 mb-3 text-primaryfw-800">{{ $offer->title }}</h3>
                        <p class="text-muted small mb-4 flex-grow-1">{{ Str::limit($offer->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto mt-4">
                            <a href="{{ url('/tour/' . $offer->id) }}" class="fw-800 text-primary text-decoration-none hover-primary-light transition-all">Lihat Detail <i class="fas fa-arrow-right ms-1 smaller"></i></a>
                            <a href="{{ url('/search?origin=Jambi&destination=Padang') }}" class="btn btn-premium btn-sm rounded-pill px-4 shadow-sm">Pesan Kini</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="glass-card p-5 rounded-5">
                    <i class="fas fa-umbrella-beach fa-4x text-muted mb-4"></i>
                    <h3>Belum ada paket tersedia</h3>
                    <p class="text-muted">Kembali lagi nanti untuk penawaran menarik lainnya!</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
