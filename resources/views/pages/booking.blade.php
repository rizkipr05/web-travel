@extends('layouts.app')

@section('title', 'Pemesanan - Safa Marwa Portal')

@section('styles')
<style>
    .seat-map-wrapper-premium {
        background: var(--bg-soft);
        padding: 3rem;
        border-radius: 2.5rem;
        border: 2px solid var(--border);
    }
    .seat-grid-premium {
        display: grid;
        grid-template-columns: repeat(2, 1fr) 40px repeat(2, 1fr);
        gap: 15px;
        max-width: 350px;
        margin: 0 auto;
    }
    .seat-premium {
        width: 55px;
        height: 55px;
        background: white;
        border: 2px solid var(--border);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 800;
        font-size: 0.95rem;
        color: var(--text-muted);
    }
    .seat-premium:hover:not(.booked) {
        border-color: var(--primary-light);
        color: var(--primary-light);
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }
    .seat-premium.selected {
        background: var(--primary-light);
        border-color: var(--primary-light);
        color: white;
        box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
    }
    .seat-premium.booked {
        background: #f1f5f9;
        border-color: #f1f5f9;
        color: #cbd5e1;
        cursor: not-allowed;
    }
    .aisle { width: 40px; }
</style>
@endsection

@section('content')
<div class="container py-5" style="margin-top: 100px">
    <div class="mb-5 animate-slide-up">
        <a href="{{ url('/') }}" class="text-primary-light fw-bold text-decoration-none small">
            <i class="fas fa-arrow-left me-2"></i> KEMBALI KE PENCARIAN
        </a>
        <h1 class="display-3 fw-800 mt-3 text-primary">Reservasi <span class="text-primary-light">Perjalanan Anda.</span></h1>
    </div>

    <div class="row g-5">
        <!-- Input Form & Seat Map -->
        <div class="col-lg-8">
            <div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-lg animate-slide-up">
                <form id="bookingForm" action="{{ url('/booking') }}" method="POST">
                    @csrf
                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                    <input type="hidden" name="passengers" value="{{ $passengers }}">
                    <input type="hidden" name="selected_seats" id="selectedSeatsInput" required>

                    <!-- Passenger Info -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-primary-light bg-opacity-10 text-primary-light p-3 rounded-4">
                                <i class="fas fa-user-check fs-4"></i>
                            </div>
                            <h2 class="h4 fw-800 text-primary mb-0">Informasi Penumpang</h2>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-primary small mb-2">Nama Lengkap</label>
                                <input type="text" name="name" class="form-input-premium" placeholder="Nama sesuai ID" required value="{{ Auth::user()->name ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-primary small mb-2">Nomor Telepon</label>
                                <input type="tel" name="phone" class="form-input-premium" placeholder="+62 8..." required>
                            </div>
                        </div>
                    </div>

                    <!-- Pickup/Dropoff -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-accent bg-opacity-10 text-accent p-3 rounded-4">
                                <i class="fas fa-map-pin fs-4"></i>
                            </div>
                            <h2 class="h4 fw-800 text-primary mb-0">Lokasi Penjemputan</h2>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-primary small mb-2">Titik Jemput</label>
                                <textarea name="pickup" class="form-input-premium" rows="3" placeholder="Alamat lengkap penjemputan" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-primary small mb-2">Titik Antar</label>
                                <textarea name="dropoff" class="form-input-premium" rows="3" placeholder="Alamat lengkap tujuan" required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Seat Map -->
                    <div>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-primary-light bg-opacity-10 text-primary-light p-3 rounded-4">
                                <i class="fas fa-chair fs-4"></i>
                            </div>
                            <h2 class="h4 fw-800 text-primary mb-0">Pilih Kursi</h2>
                        </div>
                        
                        <div class="badge bg-primary-light bg-opacity-10 text-primary-light p-3 rounded-4 w-100 mb-4 text-start">
                            <i class="fas fa-info-circle me-2"></i> Mohon pilih tepat <strong>{{ $passengers }}</strong> kursi untuk melanjutkan.
                        </div>

                        <div class="seat-map-wrapper-premium">
                            <div class="seat-grid-premium">
                                <div class="col-12 text-center text-muted fw-bold mb-4 smaller border-bottom pb-3 uppercase letter-spacing-1" style="grid-column: 1/6">
                                    <i class="fas fa-steering-wheel me-2"></i> DEPAN / ARAH KOKPIT
                                </div>
                                @php
                                    $total_seats = $schedule->vehicle->total_seats;
                                    $rows = ceil($total_seats / 4);
                                    $sc = 1;
                                @endphp
                                @for($r = 0; $r < $rows; $r++)
                                    @for($c = 0; $c < 5; $c++)
                                        @if($c == 2)
                                            <div class="aisle"></div>
                                            @continue
                                        @endif
                                        @if($sc > $total_seats) @break @endif
                                        
                                        @php $is_booked = in_array($sc, $booked_seats); @endphp
                                        <div class="seat-premium {{ $is_booked ? 'booked' : 'available' }}" 
                                             data-seat="{{ $sc }}">
                                            {{ $sc }}
                                        </div>
                                        @php $sc++; @endphp
                                    @endfor
                                @endfor
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-4 gap-md-5 mt-5">
                            <div class="d-flex align-items-center gap-2">
                                <div class="seat-premium available" style="width: 25px; height: 25px; cursor: default; font-size: 0"></div>
                                <span class="smaller text-muted fw-bold">Tersedia</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="seat-premium selected" style="width: 25px; height: 25px; cursor: default; font-size: 0"></div>
                                <span class="smaller text-muted fw-bold">Terpilih</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="seat-premium booked" style="width: 25px; height: 25px; cursor: default; font-size: 0"></div>
                                <span class="smaller text-muted fw-bold">Terisi</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 120px;">
                <div class="glass-card p-4 rounded-5 shadow-xl border-0 animate-slide-up">
                    <h3 class="h5 fw-800 text-primary mb-4">Ringkasan Perjalanan</h3>
                    
                    <div class="summary-card bg-light bg-opacity-50 p-4 rounded-4 mb-4">
                        <span class="d-block text-muted smaller fw-bold mb-2">RUTE PERJALANAN</span>
                        <div class="h5 fw-800 text-primary mb-0 d-flex align-items-center gap-3">
                            {{ $schedule->route->origin }} 
                            <i class="fas fa-long-arrow-alt-right text-primary-light"></i> 
                            {{ $schedule->route->destination }}
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="bg-light bg-opacity-50 p-3 rounded-4 text-center">
                                <span class="d-block text-muted smaller fw-bold mb-1">JAM</span>
                                <span class="h5 fw-800 text-primary">{{ date('H:i', strtotime($schedule->departure_time)) }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light bg-opacity-50 p-3 rounded-4 text-center">
                                <span class="d-block text-muted smaller fw-bold mb-1">KURSI</span>
                                <span id="displaySeats" class="h5 fw-800 text-primary-light">---</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-top border-light">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="text-muted fw-bold small">TOTAL BAYAR</span>
                            <h2 class="h3 fw-800 text-primary mb-0">Rp {{ number_format($schedule->route->price * $passengers, 0, ',', '.') }}</h2>
                        </div>
                        
                        <button type="submit" form="bookingForm" id="bookBtn" class="btn btn-premium w-100 py-3 shadow-premium" disabled>
                            KONFIRMASI PESANAN
                        </button>
                        <p id="seatWarning" class="text-danger smaller text-center mt-3 fw-bold">
                            <i class="fas fa-exclamation-triangle me-1"></i> Silakan pilih {{ $passengers }} kursi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const maxSeats = {{ $passengers }};
    const selectedSeats = [];
    const seatDisplay = document.getElementById('displaySeats');
    const seatInput = document.getElementById('selectedSeatsInput');
    const bookBtn = document.getElementById('bookBtn');
    const seatWarning = document.getElementById('seatWarning');

    document.querySelectorAll('.seat-premium.available').forEach(seat => {
        seat.addEventListener('click', () => {
            const seatNum = seat.dataset.seat;
            
            if (selectedSeats.includes(seatNum)) {
                selectedSeats.splice(selectedSeats.indexOf(seatNum), 1);
                seat.classList.remove('selected');
            } else if (selectedSeats.length < maxSeats) {
                selectedSeats.push(seatNum);
                seat.classList.add('selected');
            }

            seatDisplay.textContent = selectedSeats.length > 0 ? selectedSeats.sort((a,b) => a-b).join(', ') : '---';
            seatInput.value = selectedSeats.join(',');
            
            if (selectedSeats.length === maxSeats) {
                bookBtn.disabled = false;
                seatWarning.classList.add('d-none');
            } else {
                bookBtn.disabled = true;
                seatWarning.classList.remove('d-none');
            }
        });
    });
</script>
@endsection
