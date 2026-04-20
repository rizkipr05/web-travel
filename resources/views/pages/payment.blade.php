@extends('layouts.app')

@section('title', 'Pembayaran - Safa Marwa Portal')

@section('content')
<div class="container py-5" style="margin-top: 100px">
    <div class="row justify-content-center">
        <div class="col-lg-6 animate-slide-up">
            <div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-lg text-center">
                <div class="mb-5">
                    <div class="bg-primary-light bg-opacity-10 text-primary-light i-circle mx-auto mb-4 animate-pulse-premium" style="width: 100px; height: 100px; font-size: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 50%">
                        <i class="fas fa-shield-check"></i>
                    </div>
                    <h1 class="h2 fw-800 text-primary mb-2">Konfirmasi Pembayaran</h1>
                    <p class="text-muted">Satu langkah lagi untuk petualangan Anda dimulai.</p>
                </div>

                <div class="summary-card bg-light bg-opacity-50 p-4 rounded-4 mb-5 text-start border-start border-4 border-primary-light">
                    <div class="row g-4">
                        <div class="col-6">
                            <span class="d-block text-muted smaller fw-bold mb-1 uppercase">KODE BOOKING</span>
                            <span class="h6 fw-800 text-primary">{{ $booking->booking_code }}</span>
                        </div>
                        <div class="col-6">
                            <span class="d-block text-muted smaller fw-bold mb-1 uppercase">TOTAL HARGA</span>
                            <span class="h6 fw-800 text-primary-light">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="col-12 border-top border-light pt-3">
                            <span class="d-block text-muted smaller fw-bold mb-1 uppercase">NOMOR KURSI</span>
                            <div class="d-flex gap-2">
                                @foreach($booking->bookedSeats as $seat)
                                    <span class="badge bg-white text-primary border border-light px-3 py-2 rounded-3 fw-bold">{{ $seat->seat_number }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="payment-actions">
                    <button id="pay-button" class="btn btn-premium w-100 py-3 shadow-premium mb-4">
                        <i class="fas fa-credit-card me-2"></i> BAYAR SEKARANG
                    </button>
                    <div class="d-flex justify-content-center align-items-center gap-3 opacity-50">
                        <i class="fas fa-lock small"></i>
                        <span class="smaller fw-bold">AES-256 ENCRYPTED</span>
                        <div class="border-start" style="height: 15px"></div>
                        <i class="fab fa-cc-visa"></i>
                        <i class="fab fa-cc-mastercard"></i>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ url('/') }}" class="text-primary-light fw-bold text-decoration-none small transition-all">
                    <i class="fas fa-chevron-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){ window.location.href = "{{ url('/my-bookings') }}"; },
            onPending: function(result){ window.location.href = "{{ url('/my-bookings') }}"; },
            onError: function(result){ alert("Pembayaran gagal!"); console.log(result); }
        });
    };
</script>
@endsection
