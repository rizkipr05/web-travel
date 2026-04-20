@extends('layouts.admin')

@section('title', 'Manage Bookings - Safa Marwa Admin')

@section('content')
<div class="mb-5 d-flex flex-column flex-md-row justify-content-between align-items-center gap-4 animate-slide-up">
    <div>
        <h1 class="h2 fw-800 text-primary mb-1 uppercase letter-spacing-1">SENTRAL RESERVASI</h1>
        <p class="text-muted fw-bold smaller uppercase">MONITORING SELURUH MANIFEST PENUMPANG AKTIF</p>
    </div>
    <div class="glass-card px-4 py-2 rounded-4 shadow-sm border-dashed text-center">
        <span class="text-muted smaller fw-800 uppercase">TOTAL MANIFEST</span>
        <div class="h4 text-primary fw-900 mb-0">{{ $bookings->count() }}</div>
    </div>
</div>

<div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-premium overflow-hidden animate-slide-up">
    <div class="table-responsive">
        <table class="table table-hover align-middle custom-table-premium">
            <thead>
                <tr class="smaller text-muted uppercase fw-800 border-0">
                    <th class="border-0 pb-3 ps-4">STAMP</th>
                    <th class="border-0 pb-3">REFERENSI</th>
                    <th class="border-0 pb-3">PENUMPANG</th>
                    <th class="border-0 pb-3">RUTE & JADWAL</th>
                    <th class="border-0 pb-3 text-center">STATUS</th>
                    <th class="border-0 pb-3 text-end pe-4">KONTROL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr class="transition-all">
                        <td class="ps-4">
                            <span class="smaller fw-800 text-muted d-block">{{ $booking->created_at->format('d/m/Y') }}</span>
                            <span class="smaller text-primary-light fw-bold">{{ $booking->created_at->format('H:i') }}</span>
                        </td>
                        <td class="fw-800 text-primary">{{ $booking->booking_code }}</td>
                        <td>
                            <div class="fw-800 text-dark small uppercase">{{ $booking->user_name }}</div>
                            <div class="smaller text-muted fw-bold">{{ $booking->phone }}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 fw-800 px-2 rounded-3">{{ $booking->schedule->route->origin ?? 'N/A' }}</span>
                                <i class="fas fa-long-arrow-alt-right opacity-50"></i>
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 fw-800 px-2 rounded-3">{{ $booking->schedule->route->destination ?? 'N/A' }}</span>
                            </div>
                            <div class="smaller text-muted fw-bold">{{ date('d M, H:i', strtotime($booking->schedule->departure_time)) }}</div>
                        </td>
                        <td class="text-center">
                            @php
                                $status_map = [
                                    'pending' => ['warning', 'WAITING'],
                                    'paid' => ['success', 'VERIFIED'],
                                    'completed' => ['info', 'DONE'],
                                    'cancelled' => ['danger', 'VOID']
                                ];
                                $s = $status_map[$booking->status] ?? ['secondary', strtoupper($booking->status)];
                            @endphp
                            <span class="badge bg-{{ $s[0] }}-light bg-opacity-10 text-{{ $s[0] }} rounded-pill px-3 py-2 smaller fw-800 border">
                                <i class="fas fa-circle smaller me-1"></i> {{ $s[1] }}
                            </span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-white btn-sm rounded-3 border shadow-sm px-3 hover-accent transition-all btn-edit-status" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editStatusModal"
                                        data-id="{{ $booking->id }}"
                                        data-status="{{ $booking->status }}"
                                        data-code="{{ $booking->booking_code }}"
                                        title="Ubah Status">
                                    <i class="fas fa-edit small text-primary"></i>
                                </button>
                                <form action="{{ url('/admin/bookings/' . $booking->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-white btn-sm rounded-3 border shadow-sm px-3 hover-danger transition-all" title="Hapus">
                                        <i class="fas fa-trash small text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Status Modal -->
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-5 border-0 shadow-lg">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-800 text-primary uppercase mb-0">UBAH STATUS PESANAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editStatusForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <span class="smaller text-muted fw-bold uppercase d-block mb-1">KODE BOOKING</span>
                        <h4 id="booking-code-display" class="fw-900 text-primary mb-0">---</h4>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Status Pembayaran / Perjalanan</label>
                            <select name="status" id="edit-status" class="form-select rounded-4 p-3 border-light bg-light bg-opacity-50" required>
                                <option value="pending">PENDING (MENUNGGU)</option>
                                <option value="paid">PAID (TERVERIFIKASI)</option>
                                <option value="completed">COMPLETED (SELESAI)</option>
                                <option value="cancelled">CANCELLED (VOID)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 py-3 rounded-4 fw-bold" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-premium px-5 py-3 shadow-premium">PERBARUI STATUS</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.btn-edit-status').on('click', function() {
            const id = $(this).data('id');
            const status = $(this).data('status');
            const code = $(this).data('code');

            $('#editStatusForm').attr('action', '{{ url("/admin/bookings") }}/' + id + '/status');
            $('#booking-code-display').text(code);
            $('#edit-status').val(status);
        });
    });
</script>
@endsection

