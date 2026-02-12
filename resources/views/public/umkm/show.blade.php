@extends('public.layouts.app')

@section('title', $umkm->nama_usaha . ' - Mubar Creative Hub')

@section('content')
<div class="container py-4">
    <!-- Breadcrumb Modern -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-start);">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('umkm.index') }}" class="text-decoration-none" style="color: var(--primary-start);">
                            Katalog Ekraf
                        </a>
                    </li>
                    <li class="breadcrumb-item active fw-semibold" aria-current="page">{{ Str::limit($umkm->nama_usaha, 30) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <!-- UMKM Profile Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
                <!-- Header with Gradient -->
                <div class="card-header border-0 text-white p-4" style="background: var(--primary-gradient);">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="h3 mb-1 fw-bold">{{ $umkm->nama_usaha }}</h1>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span class="badge bg-white text-primary px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                                    <i class="fas fa-tag me-1"></i>{{ $umkm->subsektor->nama_subsektor }}
                                </span>
                                <span class="badge {{ $umkm->verification_status_badge_class }} text-white px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                                    <i class="fas fa-{{ $umkm->status_verifikasi ? 'check-circle' : 'exclamation-circle' }} me-1"></i>{{ $umkm->verification_status_label }}
                                </span>
                                <span class="badge bg-white bg-opacity-25 px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                                    <i class="fas fa-calendar me-1"></i>Sejak {{ $umkm->tahun_berdiri }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Logo Section -->
                        <div class="col-md-4">
                            <div class="position-relative" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                @if($umkm->logo)
                                    <img src="{{ Storage::url($umkm->logo) }}"
                                         class="img-fluid w-100"
                                         alt="{{ $umkm->nama_usaha }}"
                                         style="aspect-ratio: 1; object-fit: cover;">
                                @else
                                    <div class="w-100 d-flex align-items-center justify-content-center bg-light"
                                         style="aspect-ratio: 1;">
                                        <i class="fas fa-store fa-4x text-muted opacity-50"></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="col-md-8">
                            <div class="info-grid">
                                <!-- Info Item -->
                                <div class="info-item mb-3 pb-3 border-bottom">
                                    <div class="d-flex align-items-start">
                                        <div class="info-icon me-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width: 40px; height: 40px; background: var(--primary-light);">
                                                <i class="fas fa-user" style="color: var(--primary-start);"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block mb-1">Pemilik Usaha</small>
                                            <p class="mb-0 fw-semibold text-dark">{{ $umkm->nama_pemilik }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-item mb-3 pb-3 border-bottom">
                                    <div class="d-flex align-items-start">
                                        <div class="info-icon me-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width: 40px; height: 40px; background: #fee2e2;">
                                                <i class="fas fa-map-marker-alt text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block mb-1">Alamat Lengkap</small>
                                            <p class="mb-0 fw-semibold text-dark">
                                                {{ $umkm->alamat_usaha }}, {{ $umkm->desa->nama_desa }}, {{ $umkm->kecamatan->nama_kecamatan }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="info-item">
                                            <div class="d-flex align-items-start">
                                                <div class="info-icon me-2">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width: 36px; height: 36px; background: #dbeafe;">
                                                        <i class="fas fa-building" style="color: var(--primary-start); font-size: 0.875rem;"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Badan Usaha</small>
                                                    <p class="mb-0 fw-bold" style="color: var(--primary-start);">{{ $umkm->jenis_badan_usaha }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    @if($umkm->deskripsi)
                    <div class="mt-4 pt-4 border-top">
                        <h4 class="fw-bold mb-3" style="color: var(--primary-start);">
                            <i class="fas fa-info-circle me-2"></i>Tentang Usaha
                        </h4>
                        <div class="description-text p-3" style="background: #f9fafb; border-radius: 10px; line-height: 1.8;">
                            <p class="mb-0 text-dark">{!! nl2br(e($umkm->deskripsi)) !!}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Contact & Social Media Section -->
                    <div class="mt-4 pt-4 border-top">
                        <h5 class="fw-bold mb-3" style="color: var(--primary-start);">
                            <i class="fas fa-phone-alt me-2"></i>Hubungi Kami
                        </h5>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="https://wa.me/{{ formatPhoneNumber($umkm->no_telp) }}?text={{ createWhatsAppMessage('Halo '.$umkm->nama_usaha.', saya ingin bertanya tentang produk Anda.') }}"
                               target="_blank"
                               class="btn btn-success flex-grow-1"
                               style="border-radius: 10px; padding: 0.75rem 1.25rem; font-weight: 500;">
                                <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                            </a>

                            @if($umkm->facebook)
                            <a href="{{ $umkm->facebook }}"
                               target="_blank"
                               class="btn btn-outline-primary"
                               style="border-radius: 10px; padding: 0.75rem 1.25rem; border-width: 2px;">
                                <i class="fab fa-facebook"></i>
                            </a>
                            @endif

                            @if($umkm->instagram)
                            <a href="{{ $umkm->instagram }}"
                               target="_blank"
                               class="btn btn-outline-danger"
                               style="border-radius: 10px; padding: 0.75rem 1.25rem; border-width: 2px;">
                                <i class="fab fa-instagram"></i>
                            </a>
                            @endif

                            @if($umkm->tiktok)
                            <a href="{{ $umkm->tiktok }}"
                               target="_blank"
                               class="btn btn-outline-dark"
                               style="border-radius: 10px; padding: 0.75rem 1.25rem; border-width: 2px;">
                                <i class="fab fa-tiktok"></i>
                            </a>
                            @endif

                            @if($umkm->website)
                            <a href="{{ $umkm->website }}"
                               target="_blank"
                               class="btn btn-outline-info"
                               style="border-radius: 10px; padding: 0.75rem 1.25rem; border-width: 2px;">
                                <i class="fas fa-globe"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header border-0 text-white p-4" style="background: var(--primary-gradient);">
                    <h2 class="h4 mb-0 fw-bold">
                        <i class="fas fa-shopping-bag me-2"></i>Produk dari {{ $umkm->nama_usaha }}
                    </h2>
                </div>
                <div class="card-body p-4">
                    @if($umkm->produks->count() > 0)
                    <div class="row g-3">
                        @foreach($umkm->produks as $produk)
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
                                <div class="position-relative" style="height: 180px; overflow: hidden;">
                                    @if($produk->foto_1)
                                        <img src="{{ Storage::url($produk->foto_1) }}"
                                             class="card-img-top w-100 h-100"
                                             alt="{{ $produk->nama_produk }}"
                                             style="object-fit: cover; transition: transform 0.3s ease;"
                                             onmouseover="this.style.transform='scale(1.05)'"
                                             onmouseout="this.style.transform='scale(1)'">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                            <i class="fas fa-box fa-3x text-muted opacity-50"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body p-3">
                                    <h5 class="card-title fw-bold mb-2" style="color: var(--primary-start); font-size: 1rem;">
                                        {{ $produk->nama_produk }}
                                    </h5>
                                    <a href="{{ route('produk.show', $produk->id) }}"
                                       class="btn btn-primary btn-sm w-100"
                                       style="border-radius: 8px; padding: 0.625rem; font-weight: 500;">
                                        <i class="fas fa-eye me-1"></i>Lihat Detail Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-4x text-muted mb-3 opacity-50"></i>
                        <h5 class="text-muted mb-2">Belum Ada Produk</h5>
                        <p class="text-muted mb-0">Produk ini akan segera hadir.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Related UMKMs -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header border-0 text-white p-3" style="background: var(--primary-gradient);">
                    <h2 class="h5 mb-0 fw-bold">
                        <i class="fas fa-store me-2"></i>Pelaku Ekraf Sejenis
                    </h2>
                </div>
                <div class="card-body p-3">
                    @if($relatedUmkm->count() > 0)
                        @foreach($relatedUmkm as $relUmkm)
                        <a href="{{ route('umkm.show', $relUmkm->id) }}" class="text-decoration-none">
                            <div class="d-flex align-items-center p-2 mb-2 rounded hover-item"
                                 style="transition: all 0.3s ease; cursor: pointer;"
                                 onmouseover="this.style.background='var(--primary-light)'"
                                 onmouseout="this.style.background='transparent'">
                                <div class="position-relative me-3" style="flex-shrink: 0;">
                                    @if($relUmkm->logo)
                                        <img src="{{ Storage::url($relUmkm->logo) }}"
                                             class="rounded"
                                             width="60"
                                             height="60"
                                             alt="{{ $relUmkm->nama_usaha }}"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-store text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-semibold" style="color: var(--primary-start);">
                                        {{ Str::limit($relUmkm->nama_usaha, 30) }}
                                    </h6>
                                    <span class="badge bg-light text-dark" style="font-size: 0.75rem; font-weight: 500;">
                                        {{ $relUmkm->subsektor->nama_subsektor }}
                                    </span>
                                </div>
                                <i class="fas fa-chevron-right text-muted" style="font-size: 0.875rem;"></i>
                            </div>
                        </a>
                        @endforeach
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-store-slash fa-3x text-muted mb-3 opacity-50"></i>
                        <p class="text-muted mb-0 small">Tidak ada UMKM sejenis</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Styles for Detail Page */
.breadcrumb-item + .breadcrumb-item::before {
    color: #9ca3af;
}

.breadcrumb-item.active {
    color: #6b7280;
}

.info-item {
    transition: all 0.3s ease;
}

.description-text {
    font-size: 0.95rem;
}

.btn-outline-primary:hover,
.btn-outline-secondary:hover,
.btn-outline-danger:hover,
.btn-outline-info:hover,
.btn-outline-dark:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.dropdown-menu {
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-item {
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background: var(--primary-light);
    padding-left: 1.5rem;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .btn-group {
        width: 100%;
    }

    .dropdown-menu {
        width: 100%;
    }

    .info-grid .col-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

/* Animation for cards */
.card {
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

@push('scripts')
<script>
    // No map initialization needed since map section was removed
</script>
@endpush
@endsection
