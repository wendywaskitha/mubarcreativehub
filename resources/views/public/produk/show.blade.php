@extends('public.layouts.app')

@section('title', $produk->nama_produk . ' - Mubar Creative Hub')

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
                    <li class="breadcrumb-item">
                        <a href="{{ route('umkm.show', $produk->umkm->id) }}" class="text-decoration-none" style="color: var(--primary-start);">
                            {{ Str::limit($produk->umkm->nama_usaha, 30) }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active fw-semibold" aria-current="page">{{ Str::limit($produk->nama_produk, 30) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <!-- Product Gallery -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
                <div class="card-body p-0">
                    @php
                        $photos = [$produk->foto_1, $produk->foto_2, $produk->foto_3, $produk->foto_4, $produk->foto_5];
                        $photos = array_filter($photos);
                    @endphp

                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if(count($photos) > 0)
                                @foreach($photos as $index => $photo)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ Storage::url($photo) }}"
                                             class="d-block w-100"
                                             style="height: 500px; object-fit: contain; background: #f9fafb;"
                                             alt="{{ $produk->nama_produk }}">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item active">
                                    <div class="w-100 d-flex align-items-center justify-content-center"
                                         style="height: 500px; background: linear-gradient(135deg, var(--primary-light) 0%, #e0e7ff 100%);">
                                        <i class="fas fa-box-open fa-5x text-muted opacity-25"></i>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if(count($photos) > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center"
                                     style="width: 45px; height: 45px;">
                                    <i class="fas fa-chevron-left" style="color: var(--primary-start);"></i>
                                </div>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center"
                                     style="width: 45px; height: 45px;">
                                    <i class="fas fa-chevron-right" style="color: var(--primary-start);"></i>
                                </div>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif

                        @if(count($photos) > 1)
                        <div class="carousel-indicators position-absolute bottom-0 mb-3">
                            @foreach($photos as $index => $photo)
                                <button type="button"
                                        data-bs-target="#productCarousel"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index == 0 ? 'active' : '' }}"
                                        aria-label="Slide {{ $index + 1 }}"
                                        style="width: 10px; height: 10px; border-radius: 50%;"></button>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if(count($photos) > 1)
                    <div class="p-3 border-top">
                        <div class="row g-2">
                            @foreach($photos as $index => $photo)
                            <div class="col-2">
                                <div class="thumbnail-item position-relative cursor-pointer"
                                     data-bs-target="#productCarousel"
                                     data-bs-slide-to="{{ $index }}"
                                     style="cursor: pointer;">
                                    <img src="{{ Storage::url($photo) }}"
                                         class="w-100 rounded"
                                         style="height: 70px; object-fit: cover; border: 2px solid {{ $index == 0 ? 'var(--primary-start)' : '#e5e7eb' }};"
                                         alt="Thumbnail {{ $index + 1 }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4 p-lg-5">
                    <!-- Product Header -->
                    <div class="mb-4 pb-4 border-bottom">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="flex-grow-1">
                                <h1 class="h3 fw-bold mb-3" style="color: var(--primary-start); line-height: 1.4;">
                                    {{ $produk->nama_produk }}
                                </h1>

                                @if($produk->kategori)
                                <span class="badge px-3 py-2 me-2"
                                      style="background: var(--primary-light); color: var(--primary-start); border-radius: 8px; font-weight: 500;">
                                    <i class="fas fa-tag me-1"></i>{{ $produk->kategori }}
                                </span>
                                @endif

                                @if($produk->status_tersedia)
                                    <span class="badge bg-success px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                                        <i class="fas fa-check-circle me-1"></i>Tersedia
                                    </span>
                                @else
                                    <span class="badge bg-danger px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                                        <i class="fas fa-times-circle me-1"></i>Habis
                                    </span>
                                @endif
                            </div>

                            <!-- Wishlist Button -->
                            <button class="btn btn-light rounded-circle shadow-sm" style="width: 48px; height: 48px; padding: 0;">
                                <i class="fas fa-heart text-danger fs-5"></i>
                            </button>
                        </div>


                        <!-- Tags -->
                        @if($produk->tags)
                        <div class="d-flex flex-wrap gap-2 mt-3">
                            @foreach($produk->tags as $tag)
                            <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                                #{{ $tag }}
                            </span>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4 pb-4 border-bottom">
                        <h5 class="fw-bold mb-3" style="color: var(--primary-start);">
                            <i class="fas fa-info-circle me-2"></i>Deskripsi Produk
                        </h5>
                        <div class="description-text" style="line-height: 1.8; color: #374151;">
                            {!! nl2br(e($produk->deskripsi)) !!}
                        </div>
                    </div>

                    <!-- Product Specifications -->
                    @if($produk->berat || $produk->ukuran || $produk->warna)
                    <div class="mb-4 pb-4 border-bottom">
                        <h5 class="fw-bold mb-3" style="color: var(--primary-start);">
                            <i class="fas fa-clipboard-list me-2"></i>Spesifikasi
                        </h5>
                        <div class="row g-3">
                            @if($produk->berat)
                            <div class="col-md-4">
                                <div class="p-3 rounded" style="background: #f9fafb;">
                                    <small class="text-muted d-block mb-1">Berat</small>
                                    <strong style="color: var(--primary-start);">{{ $produk->berat }}</strong>
                                </div>
                            </div>
                            @endif
                            @if($produk->ukuran)
                            <div class="col-md-4">
                                <div class="p-3 rounded" style="background: #f9fafb;">
                                    <small class="text-muted d-block mb-1">Ukuran</small>
                                    <strong style="color: var(--primary-start);">{{ $produk->ukuran }}</strong>
                                </div>
                            </div>
                            @endif
                            @if($produk->warna)
                            <div class="col-md-4">
                                <div class="p-3 rounded" style="background: #f9fafb;">
                                    <small class="text-muted d-block mb-1">Warna</small>
                                    <strong style="color: var(--primary-start);">{{ $produk->warna }}</strong>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-grid gap-3">
                        <a href="https://wa.me/{{ formatPhoneNumber($produk->umkm->no_telp) }}?text={{ createWhatsAppMessage('Halo '.$produk->umkm->nama_usaha.', saya tertarik dengan *'.$produk->nama_produk.'*. Apakah masih tersedia?') }}"
                           target="_blank"
                           class="btn btn-success btn-lg"
                           style="border-radius: 12px; padding: 1rem 2rem; font-weight: 600;">
                            <i class="fab fa-whatsapp me-2 fs-5"></i>Pesan via WhatsApp
                        </a>

                        <!-- Share Section -->
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3" style="color: var(--primary-start);">
                                <i class="fas fa-share-alt me-2"></i>Bagikan Produk Ini
                            </h6>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($produk->nama_produk . ' dari ' . $produk->umkm->nama_usaha . ' - ' . url()->current()) }}"
                                   target="_blank"
                                   class="btn btn-success"
                                   style="border-radius: 10px; padding: 0.75rem 1rem; flex: 1; min-width: 120px;">
                                    <i class="fab fa-whatsapp me-2"></i> WhatsApp
                                </a>

                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                   target="_blank"
                                   class="btn btn-primary"
                                   style="border-radius: 10px; padding: 0.75rem 1rem; flex: 1; min-width: 120px;">
                                    <i class="fab fa-facebook me-2"></i> Facebook
                                </a>

                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($produk->nama_produk . ' dari ' . $produk->umkm->nama_usaha) }}"
                                   target="_blank"
                                   class="btn btn-info text-white"
                                   style="border-radius: 10px; padding: 0.75rem 1rem; flex: 1; min-width: 120px;">
                                    <i class="fab fa-twitter me-2"></i> Twitter
                                </a>

                                <button class="btn btn-light border"
                                        onclick="copyToClipboard('{{ url()->current() }}')"
                                        style="border-radius: 10px; padding: 0.75rem 1rem; flex: 1; min-width: 120px;">
                                    <i class="fas fa-copy me-2"></i> Salin Tautan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- UMKM Info Card - Enhanced -->
            <div class="card border-0 shadow-sm mb-4 overflow-hidden" style="border-radius: 16px;">
                <!-- Gradient Header dengan Pattern -->
                <div class="position-relative p-4 text-white" style="background: var(--primary-gradient);">
                    <!-- Decorative Pattern -->
                    <div class="position-absolute w-100 h-100 top-0 start-0"
                         style="opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 40L40 0H20L0 20M40 40V20L20 40\'/%3E%3C/g%3E%3C/svg%3E');"></div>

                    <div class="position-relative">
                        <div class="d-flex align-items-center mb-2">
                            <div class="rounded-circle bg-white bg-opacity-20 p-2 me-2">
                                <i class="fas fa-store fs-5"></i>
                            </div>
                            <h2 class="h6 mb-0 fw-bold">Informasi Pelaku Ekraf</h2>
                        </div>
                        <p class="mb-0 small opacity-90">Produk ini dijual oleh</p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- UMKM Profile -->
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block mb-3">
                            @if($produk->umkm->logo)
                                <img src="{{ Storage::url($produk->umkm->logo) }}"
                                     class="rounded-circle shadow"
                                     width="100"
                                     height="100"
                                     style="object-fit: cover; border: 4px solid white; box-shadow: 0 0 0 3px var(--primary-light) !important;"
                                     alt="{{ $produk->umkm->nama_usaha }}">
                            @else
                                <div class="rounded-circle shadow d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 100px; height: 100px; background: var(--primary-light); border: 4px solid white; box-shadow: 0 0 0 3px var(--primary-light) !important;">
                                    <i class="fas fa-store" style="color: var(--primary-start); font-size: 2.5rem;"></i>
                                </div>
                            @endif

                            <!-- Verified Badge -->
                            <div class="position-absolute bottom-0 end-0 bg-success rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 32px; height: 32px; border: 3px solid white;">
                                <i class="fas fa-check text-white" style="font-size: 0.75rem;"></i>
                            </div>
                        </div>

                        <h5 class="mb-1 fw-bold" style="color: var(--primary-start);">
                            {{ $produk->umkm->nama_usaha }}
                        </h5>
                        <div class="badge px-3 py-2" style="background: var(--primary-light); color: var(--primary-start); border-radius: 8px; font-weight: 500;">
                            <i class="fas fa-tag me-1"></i>{{ $produk->umkm->subsektor->nama_subsektor }}
                        </div>
                    </div>

                    <!-- Stats Info -->
                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <div class="text-center p-3 rounded" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 40px; height: 40px; background: white;">
                                        <i class="fas fa-box-open" style="color: #3b82f6;"></i>
                                    </div>
                                </div>
                                <h6 class="fw-bold mb-0" style="color: #1e40af;">{{ $produk->umkm->produks->count() }}</h6>
                                <small class="text-muted">Produk</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 rounded" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 40px; height: 40px; background: white;">
                                        <i class="fas fa-calendar-alt" style="color: #10b981;"></i>
                                    </div>
                                </div>
                                <h6 class="fw-bold mb-0" style="color: #047857;">{{ $produk->umkm->tahun_berdiri }}</h6>
                                <small class="text-muted">Berdiri</small>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3 p-3 rounded" style="background: #f9fafb;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                 style="width: 40px; height: 40px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);">
                                <i class="fas fa-map-marker-alt text-danger"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Lokasi</small>
                                <strong class="text-dark" style="font-size: 0.9rem;">
                                    {{ $produk->umkm->desa->nama_desa }}, {{ $produk->umkm->kecamatan->nama_kecamatan }}
                                </strong>
                            </div>
                        </div>

                        <div class="d-flex align-items-start p-3 rounded" style="background: #f9fafb;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                 style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--primary-light) 0%, #dbeafe 100%);">
                                <i class="fas fa-user" style="color: var(--primary-start);"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Pemilik</small>
                                <strong class="text-dark" style="font-size: 0.9rem;">{{ $produk->umkm->nama_pemilik }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        <a href="{{ route('umkm.show', $produk->umkm->id) }}"
                           class="btn btn-primary"
                           style="border-radius: 10px; padding: 0.75rem 1.5rem; font-weight: 600;">
                            <i class="fas fa-store-alt me-2"></i>Lihat Profil Lengkap
                        </a>
                        <a href="https://wa.me/{{ formatPhoneNumber($produk->umkm->no_telp) }}?text=Halo%20{{ $produk->umkm->nama_usaha }}"
                           target="_blank"
                           class="btn btn-outline-success"
                           style="border-radius: 10px; padding: 0.75rem 1.5rem; border-width: 2px; font-weight: 600;">
                            <i class="fab fa-whatsapp me-2"></i>Chat Penjual
                        </a>
                    </div>
                </div>
            </div>

            <!-- Other Products - Enhanced -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <!-- Header dengan Gradient -->
                <div class="position-relative p-3 text-white" style="background: var(--primary-gradient);">
                    <div class="position-absolute w-100 h-100 top-0 start-0"
                         style="opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 40L40 0H20L0 20M40 40V20L20 40\'/%3E%3C/g%3E%3C/svg%3E');"></div>

                    <div class="position-relative d-flex align-items-center">
                        <div class="rounded-circle bg-white bg-opacity-20 p-2 me-2">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h2 class="h6 mb-0 fw-bold">Produk Lainnya</h2>
                    </div>
                </div>

                <div class="card-body p-3">
                    @if($otherProducts->count() > 0)
                        <div class="product-list">
                            @foreach($otherProducts as $otherProduct)
                            @if($otherProduct->id != $produk->id)
                            <a href="{{ route('produk.show', $otherProduct->id) }}" class="text-decoration-none">
                                <div class="product-item d-flex align-items-center p-3 mb-2 rounded position-relative overflow-hidden"
                                     style="transition: all 0.3s ease; background: #f9fafb;">
                                    <!-- Hover Gradient Effect -->
                                    <div class="position-absolute top-0 start-0 w-100 h-100 gradient-overlay"
                                         style="background: var(--primary-gradient); opacity: 0; transition: opacity 0.3s ease;"></div>

                                    <div class="position-relative d-flex align-items-center w-100">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 me-3">
                                            <div class="position-relative">
                                                @if($otherProduct->foto_1)
                                                    <img src="{{ Storage::url($otherProduct->foto_1) }}"
                                                         class="rounded"
                                                         width="80"
                                                         height="80"
                                                         style="object-fit: cover; border: 2px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                                                         alt="{{ $otherProduct->nama_produk }}">
                                                @else
                                                    <div class="rounded d-flex align-items-center justify-content-center"
                                                         style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-light) 0%, #dbeafe 100%); border: 2px solid white;">
                                                        <i class="fas fa-box text-muted"></i>
                                                    </div>
                                                @endif

                                                @if($otherProduct->status_tersedia)
                                                <div class="position-absolute top-0 start-0 mt-1 ms-1">
                                                    <span class="badge bg-success px-2 py-1" style="font-size: 0.65rem; border-radius: 4px;">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Product Info -->
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold product-title" style="color: var(--primary-start); font-size: 0.95rem; line-height: 1.4;">
                                                {{ Str::limit($otherProduct->nama_produk, 35) }}
                                            </h6>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="mb-0 fw-bold" style="color: #10b981; font-size: 1rem;">
                                                    Rp {{ number_format($otherProduct->harga, 0, ',', '.') }}
                                                </p>
                                                <div class="arrow-icon">
                                                    <i class="fas fa-arrow-right" style="color: var(--primary-start); font-size: 0.875rem;"></i>
                                                </div>
                                            </div>
                                            @if($otherProduct->stok > 0)
                                            <small class="text-muted" style="font-size: 0.75rem;">
                                                <i class="fas fa-box me-1"></i>Stok: {{ $otherProduct->stok }}
                                            </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endif
                            @endforeach
                        </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-box-open fa-4x text-muted opacity-25"></i>
                        </div>
                        <h6 class="text-muted mb-2">Tidak Ada Produk Lain</h6>
                        <p class="text-muted small mb-0">Saat ini hanya ada 1 produk dari Pelaku Ekraf ini</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Breadcrumb */
.breadcrumb-item + .breadcrumb-item::before {
    color: #9ca3af;
}

.breadcrumb-item.active {
    color: #6b7280;
}

/* Carousel Custom Controls */
.carousel-control-prev,
.carousel-control-next {
    width: auto;
}

.carousel-control-prev {
    left: 20px;
}

.carousel-control-next {
    right: 20px;
}

.carousel-control-prev div,
.carousel-control-next div {
    transition: all 0.3s ease;
}

.carousel-control-prev:hover div,
.carousel-control-next:hover div {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}

/* Carousel Indicators */
.carousel-indicators button {
    background-color: var(--primary-start);
}

/* Thumbnail Gallery */
.thumbnail-item img {
    transition: all 0.3s ease;
    cursor: pointer;
}

.thumbnail-item:hover img {
    border-color: var(--primary-start) !important;
    transform: scale(1.05);
}

/* Description Text */
.description-text {
    font-size: 1rem;
}

/* Product Item Hover Effects */
.product-item {
    cursor: pointer;
}

.product-item:hover {
    background: white !important;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(30, 58, 138, 0.15) !important;
}

.product-item:hover .gradient-overlay {
    opacity: 0.05;
}

.product-item:hover .product-title {
    color: var(--primary-start) !important;
}

.product-item:hover .arrow-icon {
    transform: translateX(5px);
}

.arrow-icon {
    transition: transform 0.3s ease;
}

/* Dropdown Menu Animation */
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

/* Button Hover Effects */
.btn-outline-primary:hover,
.btn-outline-secondary:hover,
.btn-outline-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(30, 58, 138, 0.3);
}

/* Wishlist Button */
.btn-light:hover {
    transform: scale(1.1);
}

/* Card Animation */
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

/* Stats Card Hover */
.col-6 > div {
    transition: all 0.3s ease;
}

.col-6 > div:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Responsive */
@media (max-width: 991.98px) {
    #productCarousel .carousel-inner {
        height: 350px !important;
    }

    .product-item {
        margin-bottom: 0.75rem !important;
    }
}
</style>

<script>
// Copy to clipboard function
function copyToClipboard(text) {
    // Try the modern Clipboard API first
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Link berhasil disalin!');
        }).catch(function(err) {
            console.error('Failed to copy: ', err);
            fallbackCopyTextToClipboard(text);
        });
    } else {
        // Fallback to older method
        fallbackCopyTextToClipboard(text);
    }
}

// Fallback function for older browsers
function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.left = "-999999px";
    textArea.style.top = "-999999px";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            alert('Link berhasil disalin!');
        } else {
            alert('Gagal menyalin link. Silakan salin secara manual.');
        }
    } catch (err) {
        alert('Gagal menyalin link. Silakan salin secara manual.');
    }
    document.body.removeChild(textArea);
}

// Thumbnail click handler
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    thumbnails.forEach((thumb, index) => {
        thumb.addEventListener('click', function() {
            // Remove active border from all thumbnails
            thumbnails.forEach(t => {
                t.querySelector('img').style.borderColor = '#e5e7eb';
            });
            // Add active border to clicked thumbnail
            this.querySelector('img').style.borderColor = 'var(--primary-start)';
        });
    });

    // Update thumbnail border on carousel slide
    const carousel = document.getElementById('productCarousel');
    if (carousel) {
        carousel.addEventListener('slide.bs.carousel', function(e) {
            thumbnails.forEach((thumb, index) => {
                const img = thumb.querySelector('img');
                img.style.borderColor = index === e.to ? 'var(--primary-start)' : '#e5e7eb';
            });
        });
    }
});
</script>
@endsection
