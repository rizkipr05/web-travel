@extends('layouts.admin')

@section('title', 'Manage Tours - Safa Marwa Admin')

@section('content')
<div class="mb-5 d-flex flex-column flex-md-row justify-content-between align-items-center gap-4 animate-slide-up">
    <div>
        <h1 class="h2 fw-800 text-primary mb-1 uppercase letter-spacing-1">MANAJEMEN PAKET TOUR</h1>
        <p class="text-muted fw-bold smaller uppercase">KOLABORASI & PENERBITAN DESTINASI PREMIUM</p>
    </div>
    <button class="btn btn-premium px-5 py-3 shadow-premium" data-bs-toggle="modal" data-bs-target="#addTourModal">
        <i class="fas fa-plus-circle me-2"></i> TAMBAH PAKET BARU
    </button>
</div>

<div class="row g-4">
    @foreach($tours as $tour)
        <div class="col-md-6 col-lg-4 animate-slide-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
            <div class="glass-card h-100 rounded-5 border-0 shadow-premium overflow-hidden d-flex flex-column transition-all hover-translate-up">
                <div class="position-relative">
                    <img src="{{ \Illuminate\Support\Str::startsWith($tour->image_url, 'http') ? $tour->image_url : asset('storage/' . $tour->image_url) }}" class="w-100" style="height: 220px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=2087&auto=format&fit=crop'">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-{{ $tour->is_active ? 'success' : 'secondary' }}-light bg-opacity-10 text-{{ $tour->is_active ? 'success' : 'secondary' }} rounded-pill px-3 py-2 smaller fw-800 border bg-white">
                            <i class="fas fa-circle smaller me-1"></i> {{ $tour->is_active ? 'PUBLISHED' : 'DRAFT' }}
                        </span>
                    </div>
                </div>
                <div class="p-4 flex-grow-1">
                    <h5 class="fw-800 text-primary mb-2 uppercase">{{ $tour->title }}</h5>
                    <p class="text-muted smaller fw-bold mb-4 line-clamp-2">{{ $tour->description }}</p>
                    <div class="bg-light bg-opacity-50 p-3 rounded-4 border">
                        <div class="row g-2">
                            <div class="col-6 border-end">
                                <span class="d-block text-muted smaller fw-800 mb-1 uppercase">HARGA</span>
                                <span class="small fw-800 text-primary">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="col-6 ps-3">
                                <span class="d-block text-muted smaller fw-800 mb-1 uppercase">EXPIRED</span>
                                <span class="small fw-800 text-dark">{{ $tour->expiry_date ? date('d M Y', strtotime($tour->expiry_date)) : 'PERPETUAL' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border-top p-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <button class="btn btn-light btn-sm rounded-circle border shadow-sm btn-edit-tour" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editTourModal"
                                data-id="{{ $tour->id }}"
                                data-title="{{ $tour->title }}"
                                data-description="{{ $tour->description }}"
                                data-price="{{ (int)$tour->price }}"
                                data-expiry="{{ $tour->expiry_date }}"
                                data-active="{{ $tour->is_active }}"
                                title="Edit" style="width: 35px; height: 35px;">
                            <i class="fas fa-edit text-primary small"></i>
                        </button>
                        <form action="{{ url('/admin/tours/' . $tour->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket tour ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light btn-sm rounded-circle border shadow-sm" title="Hapus" style="width: 35px; height: 35px;">
                                <i class="fas fa-trash text-danger small"></i>
                            </button>
                        </form>
                    </div>
                    <span class="smaller fw-800 text-muted uppercase opacity-50">{{ $tour->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Add Tour Modal -->
<div class="modal fade" id="addTourModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-5 border-0 shadow-lg">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-800 text-primary uppercase mb-0">TAMBAH PAKET TOUR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/tours') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Judul Paket</label>
                            <input type="text" name="title" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50" required placeholder="Contoh: Umroh Hemat Ramadhan">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Deskripsi</label>
                            <textarea name="description" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50" rows="4" required placeholder="Jelaskan detail paket tour..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold smaller text-muted uppercase">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50" required placeholder="Contoh: 15000000">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold smaller text-muted uppercase">Tanggal Berakhir</label>
                            <input type="date" name="expiry_date" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold smaller text-muted uppercase">Gambar Paket</label>
                            <input type="file" name="image" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50">
                            <small class="text-muted italic">Maksimal 2MB. Format: JPG, PNG, WEBP.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold smaller text-muted uppercase">Status</label>
                            <select name="is_active" class="form-select rounded-4 p-3 border-light bg-light bg-opacity-50">
                                <option value="1">PUBLISHED</option>
                                <option value="0">DRAFT</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 py-3 rounded-4 fw-bold" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-premium px-5 py-3 shadow-premium">SIMPAN PAKET</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Tour Modal -->
<div class="modal fade" id="editTourModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-5 border-0 shadow-lg">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-800 text-primary uppercase mb-0">EDIT PAKET TOUR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editTourForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Judul Paket</label>
                            <input type="text" name="title" id="edit-title" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold smaller text-muted uppercase">Deskripsi</label>
                            <textarea name="description" id="edit-description" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50" rows="4" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold smaller text-muted uppercase">Harga (Rp)</label>
                            <input type="number" name="price" id="edit-price" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold smaller text-muted uppercase">Tanggal Berakhir</label>
                            <input type="date" name="expiry_date" id="edit-expiry" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold smaller text-muted uppercase">Gambar Baru (Opsional)</label>
                            <input type="file" name="image" class="form-control rounded-4 p-3 border-light bg-light bg-opacity-50">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold smaller text-muted uppercase">Status</label>
                            <select name="is_active" id="edit-active" class="form-select rounded-4 p-3 border-light bg-light bg-opacity-50">
                                <option value="1">PUBLISHED</option>
                                <option value="0">DRAFT</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 py-3 rounded-4 fw-bold" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-premium px-5 py-3 shadow-premium">PERBARUI PAKET</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.btn-edit-tour').on('click', function() {
            const id = $(this).data('id');
            const title = $(this).data('title');
            const description = $(this).data('description');
            const price = $(this).data('price');
            const expiry = $(this).data('expiry');
            const active = $(this).data('active');

            $('#editTourForm').attr('action', '{{ url("/admin/tours") }}/' + id);
            $('#edit-title').val(title);
            $('#edit-description').val(description);
            $('#edit-price').val(price);
            $('#edit-expiry').val(expiry);
            $('#edit-active').val(active);
        });
    });
</script>
@endsection

