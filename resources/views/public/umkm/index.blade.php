@extends('public.layouts.app')

@section('title', 'Katalog UMKM - Mubar Creative Hub')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary-gradient mb-3">Pelaku Ekonomi Kreatif Muna Barat</h1>
            <p class="lead text-muted">Temukan berbagai produk dan layanan lokal terbaik dari Ekonomi Kreatif Muna Barat</p>
        </div>
    </div>

    <!-- Search and Filters Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0 p-4">
                <form method="GET" action="{{ route('umkm.index') }}">
                    <div class="row g-3">
                        <!-- Search Bar -->
                        <div class="col-lg-12 mb-3">
                            <div class="position-relative">
                                <input type="text"
                                       name="search"
                                       class="form-control form-control-lg ps-5"
                                       placeholder="Cari nama Pelaku Ekraf, produk, atau pemilik usaha..."
                                       style="border-radius: 12px; border: 2px solid #e5e7eb;"
                                       value="{{ request('search') }}">
                                <i class="fas fa-search position-absolute"
                                   style="left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                            </div>
                        </div>

                        <!-- Filter Section -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-muted small mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i> Kecamatan
                            </label>
                            <select name="kecamatan" class="form-select" style="border-radius: 10px;" onchange="this.form.submit()">
                                <option value="">Semua Kecamatan</option>
                                @foreach($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}" {{ request('kecamatan') == $kecamatan->id ? 'selected' : '' }}>
                                    {{ $kecamatan->nama_kecamatan }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-muted small mb-2">
                                <i class="fas fa-home me-1"></i> Desa
                            </label>
                            <select name="desa" class="form-select" style="border-radius: 10px;" onchange="this.form.submit()">
                                <option value="">Semua Desa</option>
                                @foreach($desas as $desa)
                                <option value="{{ $desa->id }}" {{ request('desa') == $desa->id ? 'selected' : '' }}>
                                    {{ $desa->nama_desa }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-muted small mb-2">
                                <i class="fas fa-tag me-1"></i> Subsektor
                            </label>
                            <select name="subsektor" class="form-select" style="border-radius: 10px;" onchange="this.form.submit()">
                                <option value="">Semua Subsektor</option>
                                @foreach($subsektors as $subsektor)
                                <option value="{{ $subsektor->id }}" {{ request('subsektor') == $subsektor->id ? 'selected' : '' }}>
                                    {{ $subsektor->nama_subsektor }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-muted small mb-2">
                                <i class="fas fa-sort me-1"></i> Urutkan
                            </label>
                            <select name="sort" class="form-select" style="border-radius: 10px;" onchange="this.form.submit()">
                                <option value="">Urutkan Berdasarkan</option>
                                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama A-Z</option>
                                <option value="populer" {{ request('sort') == 'populer' ? 'selected' : '' }}>Paling Populer</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Results Info -->
    <div class="row mb-4">
        <div class="col-12">
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-2"></i>
                Menampilkan <strong>{{ $umkms->firstItem() }}</strong> - <strong>{{ $umkms->lastItem() }}</strong> dari <strong>{{ $umkms->total() }}</strong> UMKM terdaftar
            </p>
        </div>
    </div>

    <!-- UMKM Grid -->
    <div class="row g-4 mb-5">
        @forelse($umkms as $umkm)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm overflow-hidden" style="border-radius: 16px;">
                <!-- Image Container with Overlay Badge -->
                <div class="position-relative overflow-hidden" style="height: 240px;">
                    @if($umkm->logo)
                        <img src="{{ Storage::url($umkm->logo) }}"
                             class="card-img-top w-100 h-100"
                             alt="{{ $umkm->nama_usaha }}"
                             style="object-fit: cover; transition: transform 0.3s ease;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                            <i class="fas fa-store fa-4x text-muted opacity-50"></i>
                        </div>
                    @endif

                    <!-- Category Badge -->
                    <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2"
                          style="background: rgba(30, 58, 138, 0.9); backdrop-filter: blur(10px); border-radius: 8px; font-weight: 500;">
                        <i class="fas fa-tag me-1"></i> {{ $umkm->subsektor->nama_subsektor }}
                    </span>

                    <!-- Verification Badge -->
                    <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2 {{ $umkm->verification_status_badge_class }}"
                          style="backdrop-filter: blur(10px); border-radius: 8px; font-weight: 500; font-size: 0.8rem;">
                        <i class="fas fa-{{ $umkm->status_verifikasi ? 'check-circle' : 'exclamation-circle' }} me-1"></i>
                        {{ $umkm->verification_status_label }}
                    </span>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3" style="color: #1e3a8a; font-size: 1.25rem;">
                        {{ $umkm->nama_usaha }}
                    </h5>

                    <!-- Owner & Location Info -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                 style="width: 32px; height: 32px;">
                                <i class="fas fa-user text-primary" style="font-size: 0.875rem;"></i>
                            </div>
                            <span class="text-muted small">{{ $umkm->nama_pemilik }}</span>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                 style="width: 32px; height: 32px; flex-shrink: 0;">
                                <i class="fas fa-map-marker-alt text-danger" style="font-size: 0.875rem;"></i>
                            </div>
                            <span class="text-muted small">
                                {{ $umkm->desa->nama_desa }}, {{ $umkm->kecamatan->nama_kecamatan }}
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="card-text text-muted small mb-0" style="line-height: 1.6;">
                        {{ Str::limit($umkm->deskripsi, 100) }}
                    </p>
                </div>

                <!-- Card Footer with Action Buttons -->
                <div class="card-footer bg-white border-0 p-4 pt-0">
                    <div class="d-grid gap-2">
                        <a href="{{ route('umkm.show', $umkm->id) }}"
                           class="btn btn-primary d-flex align-items-center justify-content-center"
                           style="border-radius: 10px; padding: 0.75rem;">
                            <i class="fas fa-eye me-2"></i> Lihat Detail
                        </a>
                        <a href="https://wa.me/{{ formatPhoneNumber($umkm->no_telp) }}?text={{ createWhatsAppMessage('Halo '.$umkm->nama_usaha.', saya ingin bertanya tentang produk Anda.') }}"
                           target="_blank"
                           class="btn btn-outline-success d-flex align-items-center justify-content-center"
                           style="border-radius: 10px; padding: 0.75rem; border-width: 2px; font-weight: 500;">
                            <i class="fab fa-whatsapp me-2"></i> Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 16px;">
                <div class="card-body">
                    <i class="fas fa-store-slash fa-4x text-muted mb-4 opacity-50"></i>
                    <h4 class="text-muted mb-2">Belum Ada UMKM Terdaftar</h4>
                    <p class="text-muted mb-0">Saat ini belum ada UMKM yang terdaftar dengan kriteria pencarian Anda.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($umkms->hasPages())
    <div class="row">
        <div class="col-12">
            <nav aria-label="Navigasi halaman katalog">
                {{ $umkms->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>
    @endif
</div>

<style>
/* Additional custom styles for better UX */
.form-control:focus,
.form-select:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 0.2rem rgba(96, 165, 250, 0.15);
}

.btn-outline-success {
    color: #059669;
    border-color: #059669;
    transition: all 0.3s ease;
}

.btn-outline-success:hover {
    background: #059669;
    border-color: #059669;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}

.page-link {
    transition: all 0.3s ease;
}

.page-link:not(.active):hover {
    background: var(--primary-light);
    color: var(--primary-start);
    transform: translateY(-2px);
}

.card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 28px rgba(30, 58, 138, 0.15) !important;
}

/* Badge animation */
.badge {
    animation: fadeInDown 0.6s ease;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Smooth entrance animation */
.col-lg-4, .col-md-6 {
    animation: fadeInUp 0.6s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endsection
