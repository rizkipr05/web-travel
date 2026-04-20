@extends('layouts.admin')

@section('title', 'Manage Schedules - Safa Marwa Admin')

@section('content')
<div class="mb-5 d-flex flex-column flex-md-row justify-content-between align-items-center gap-4 animate-slide-up">
    <div>
        <h1 class="h2 fw-800 text-primary mb-1 uppercase letter-spacing-1">OPERASIONAL JADWAL</h1>
        <p class="text-muted fw-bold smaller uppercase">MANAJEMEN FREKUENSI DAN KAPASITAS ARMADA</p>
    </div>
    <button class="btn btn-premium px-5 py-3 shadow-premium" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
        <i class="fas fa-calendar-plus me-2"></i> BUAT JADWAL BARU
    </button>
</div>

<div class="glass-card p-4 p-md-5 rounded-5 border-0 shadow-premium overflow-hidden animate-slide-up">
    <div class="table-responsive">
        <table class="table table-hover align-middle custom-table-premium">
            <thead>
                <tr class="smaller text-muted uppercase fw-800 border-0">
                    <th class="border-0 pb-3 ps-4">RUTE OPERASIONAL</th>
                    <th class="border-0 pb-3">ARMADA / TIPE</th>
                    <th class="border-0 pb-3">WAKTU KEBERANGKATAN</th>
                    <th class="border-0 pb-3 text-center">OKUPANSI KURSI</th>
                    <th class="border-0 pb-3 text-end pe-4">NAVIGASI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                    <tr class="transition-all">
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 fw-800 px-2 rounded-3">{{ $schedule->route->origin ?? 'Unknown' }}</span>
                                <i class="fas fa-long-arrow-alt-right opacity-50"></i>
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 fw-800 px-2 rounded-3">{{ $schedule->route->destination ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="fw-800 text-dark small uppercase">{{ $schedule->vehicle->name ?? 'N/A' }}</div>
                            <div class="smaller text-muted fw-bold">{{ $schedule->vehicle->type ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <div class="fw-800 text-primary small mb-1">{{ date('d M Y', strtotime($schedule->departure_time)) }}</div>
                            <div class="smaller text-muted fw-bold uppercase"><i class="far fa-clock me-1"></i> {{ date('H:i', strtotime($schedule->departure_time)) }} WIB</div>
                        </td>
                        <td class="text-center">
                            <div class="bg-primary-light bg-opacity-10 text-primary-light i-circle mx-auto d-flex align-items-center justify-content-center fw-900 rounded-3 mb-1" style="width: 40px; height: 30px;">
                                {{ $schedule->vehicle->total_seats ?? 0 }}
                            </div>
                            <span class="smaller text-muted fw-800 uppercase">AVAIL</span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-white btn-sm rounded-3 border shadow-sm px-3 hover-accent transition-all btn-edit-schedule" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editScheduleModal"
                                        data-id="{{ $schedule->id }}"
                                        data-route="{{ $schedule->route_id }}"
                                        data-vehicle="{{ $schedule->vehicle_id }}"
                                        data-time="{{ date('Y-m-d\TH:i', strtotime($schedule->departure_time)) }}"
                                        title="Edit">
                                    <i class="fas fa-edit small text-primary"></i>
                                </button>
                                <form action="{{ url('/admin/schedules/' . $schedule->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
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

<!-- Add Schedule Modal -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-5 border-0 shadow-lg">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-800 text-primary uppercase mb-0">BUAT JADWAL BARU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/schedules') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Rute Perjalanan</label>
                            <select name="route_id" class="form-select rounded-4 p-3 border-light bg-light bg-opacity-50" required>
                                <option value="">Pilih Rute...</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}">{{ $route->origin }} → {{ $route->destination }} (Rp {{ number_format($route->price, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Armada / Bus</label>
                            <select name="vehicle_id" class="form-select rounded-4 p-3 border-light bg-light bg-opacity-50" required>
                                <option value="">Pilih Armada...</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->type }} - {{ $vehicle->total_seats }} Kursi)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Waktu Keberangkatan</label>
                            <input type="datetime-local" name="departure_time" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 py-3 rounded-4 fw-bold" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-premium px-5 py-3 shadow-premium">SIMPAN JADWAL</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Schedule Modal -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-5 border-0 shadow-lg">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-800 text-primary uppercase mb-0">EDIT JADWAL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editScheduleForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Rute Perjalanan</label>
                            <select name="route_id" id="edit-route" class="form-select rounded-4 p-3 border-light bg-light bg-opacity-50" required>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}">{{ $route->origin }} → {{ $route->destination }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Armada / Bus</label>
                            <select name="vehicle_id" id="edit-vehicle" class="form-select rounded-4 p-3 border-light bg-light bg-opacity-50" required>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->type }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Waktu Keberangkatan</label>
                            <input type="datetime-local" name="departure_time" id="edit-time" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 py-3 rounded-4 fw-bold" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-premium px-5 py-3 shadow-premium">PERBARUI JADWAL</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.btn-edit-schedule').on('click', function() {
            const id = $(this).data('id');
            const route = $(this).data('route');
            const vehicle = $(this).data('vehicle');
            const time = $(this).data('time');

            $('#editScheduleForm').attr('action', '{{ url("/admin/schedules") }}/' + id);
            $('#edit-route').val(route);
            $('#edit-vehicle').val(vehicle);
            $('#edit-time').val(time);
        });
    });
</script>
@endsection

