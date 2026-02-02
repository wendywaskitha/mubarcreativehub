@extends('public.layouts.app')

@section('title', 'Produk - ' . ($settings['site_title'] ?? 'Mubar Creative Hub'))

@section('content')
<div class="container py-5">
    <!-- Hero Header -->
    <div class="row mb-5" data-aos="fade-up">
        <div class="col-12 text-center">
            <h1 class="display-5 fw-bold text-primary-gradient mb-3">
                <i class="fas fa-box-open me-2"></i>Katalog Produk
            </h1>
            <p class="lead text-muted">Temukan berbagai produk unggulan dari Pelaku Ekonomi Kreatif Muna Barat</p>
            <div class="d-inline-block mt-3">
                <span class="badge px-4 py-2" style="background: var(--primary-gradient); color: white; border-radius: 12px; font-size: 1rem; font-weight: 500;">
                    <i class="fas fa-cube me-2"></i>{{ $products->total() }} Produk Tersedia
                </span>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;" data-aos="fade-up">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('produk.index') }}" id="filterForm">
                <div class="row g-3">
                    <!-- Search Bar -->
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="fas fa-search me-1"></i>Cari Produk
                        </label>
                        <div class="position-relative">
                            <input type="text"
                                   name="search"
                                   class="form-control form-control-lg ps-5"
                                   placeholder="Cari nama produk, kategori, atau UMKM..."
                                   value="{{ request('search') }}"
                                   style="border-radius: 12px; border: 2px solid #e5e7eb;">
                            <i class="fas fa-search position-absolute text-muted"
                               style="left: 18px; top: 50%; transform: translateY(-50%);"></i>
                            @if(request('search'))
                            <button type="button"
                                    class="btn-close position-absolute"
                                    style="right: 18px; top: 50%; transform: translateY(-50%);"
                                    onclick="document.querySelector('input[name=search]').value=''; document.getElementById('filterForm').submit();"></button>
                            @endif
                        </div>
                    </div>

                    <!-- Filter Options -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="fas fa-tag me-1"></i>Subsektor
                        </label>
                        <select name="subsektor_id" class="form-select" style="border-radius: 10px; border: 2px solid #e5e7eb;" onchange="this.form.submit()">
                            <option value="">Semua Subsektor</option>
                            @foreach($subsektors as $subsektor)
                                <option value="{{ $subsektor->id }}" {{ request('subsektor_id') == $subsektor->id ? 'selected' : '' }}>
                                    {{ $subsektor->nama_subsektor }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="fas fa-map-marker-alt me-1"></i>Kecamatan
                        </label>
                        <select name="kecamatan_id" class="form-select" style="border-radius: 10px; border: 2px solid #e5e7eb;" onchange="this.form.submit()">
                            <option value="">Semua Kecamatan</option>
                            @foreach($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}" {{ request('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                                    {{ $kecamatan->nama_kecamatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="fas fa-map-pin me-1"></i>Desa
                        </label>
                        <select name="desa_id" class="form-select" style="border-radius: 10px; border: 2px solid #e5e7eb;" onchange="this.form.submit()">
                            <option value="">Semua Desa</option>
                            @foreach($desas as $desa)
                                <option value="{{ $desa->id }}" {{ request('desa_id') == $desa->id ? 'selected' : '' }}>
                                    {{ $desa->nama_desa }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Active Filters -->
                @if(request('search') || request('subsektor_id') || request('kecamatan_id') || request('desa_id'))
                <div class="mt-3 pt-3 border-top">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <small class="text-muted fw-semibold me-2">Filter Aktif:</small>
                        @if(request('search'))
                        <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px;">
                            Pencarian: "{{ request('search') }}"
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="text-dark ms-2">×</a>
                        </span>
                        @endif
                        @if(request('subsektor_id'))
                        <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px;">
                            {{ $subsektors->find(request('subsektor_id'))->nama_subsektor }}
                            <a href="{{ request()->fullUrlWithQuery(['subsektor_id' => null]) }}" class="text-dark ms-2">×</a>
                        </span>
                        @endif
                        @if(request('kecamatan_id'))
                        <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px;">
                            {{ $kecamatans->find(request('kecamatan_id'))->nama_kecamatan }}
                            <a href="{{ request()->fullUrlWithQuery(['kecamatan_id' => null]) }}" class="text-dark ms-2">×</a>
                        </span>
                        @endif
                        @if(request('desa_id'))
                        <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px;">
                            {{ $desas->find(request('desa_id'))->nama_desa }}
                            <a href="{{ request()->fullUrlWithQuery(['desa_id' => null]) }}" class="text-dark ms-2">×</a>
                        </span>
                        @endif
                        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                            <i class="fas fa-times me-1"></i>Hapus Semua
                        </a>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Sorting and Results Info -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4" data-aos="fade-up">
        <div class="mb-2 mb-md-0">
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-2"></i>
                Menampilkan <strong>{{ $products->firstItem() }}-{{ $products->lastItem() }}</strong> dari <strong>{{ $products->total() }}</strong> produk
            </p>
        </div>
        <div>
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle"
                        type="button"
                        id="sortDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        style="border-radius: 10px; border-width: 2px; font-weight: 500;">
                    <i class="fas fa-sort me-2"></i>Urutkan:
                    @switch(request('sort', 'latest'))
                        @case('oldest')
                            Terlama
                            @break
                        @case('name_asc')
                            A-Z
                            @break
                        @case('name_desc')
                            Z-A
                            @break
                        @case('popular')
                            Popularitas
                            @break
                        @default
                            Terbaru
                    @endswitch
                </button>
                <ul class="dropdown-menu shadow" style="border-radius: 10px; border: none;">
                    <li><a class="dropdown-item {{ request('sort') == 'latest' || !request('sort') ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}">
                        <i class="fas fa-clock me-2"></i>Terbaru
                    </a></li>
                    <li><a class="dropdown-item {{ request('sort') == 'oldest' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">
                        <i class="fas fa-history me-2"></i>Terlama
                    </a></li>
                    <li><a class="dropdown-item {{ request('sort') == 'name_asc' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}">
                        <i class="fas fa-sort-alpha-down me-2"></i>A-Z
                    </a></li>
                    <li><a class="dropdown-item {{ request('sort') == 'name_desc' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}">
                        <i class="fas fa-sort-alpha-up me-2"></i>Z-A
                    </a></li>
                    <li><a class="dropdown-item {{ request('sort') == 'popular' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}">
                        <i class="fas fa-fire me-2"></i>Popularitas
                    </a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="row g-4 mb-5">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="card h-100 product-card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                        <!-- Product Image -->
                        <div class="position-relative overflow-hidden" style="height: 240px;">
                            @if($product->foto_1)
                                <img src="{{ Storage::url($product->foto_1) }}"
                                     class="card-img-top w-100 h-100 product-img"
                                     alt="{{ $product->nama_produk }}"
                                     style="object-fit: cover; transition: transform 0.5s ease;">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                     style="background: linear-gradient(135deg, var(--primary-light) 0%, #e0e7ff 100%);">
                                    <i class="fas fa-box-open fa-4x text-muted opacity-25"></i>
                                </div>
                            @endif

                            <!-- Badges -->
                            <div class="position-absolute top-0 start-0 m-3">
                                @if($product->status_tersedia)
                                <span class="badge bg-success px-3 py-2 shadow-sm" style="border-radius: 8px; font-weight: 500;">
                                    <i class="fas fa-check-circle me-1"></i>Tersedia
                                </span>
                                @else
                                <span class="badge bg-danger px-3 py-2 shadow-sm" style="border-radius: 8px; font-weight: 500;">
                                    <i class="fas fa-times-circle me-1"></i>Habis
                                </span>
                                @endif
                            </div>

                            <!-- Wishlist Button -->
                            <div class="position-absolute top-0 end-0 m-3">
                                <button class="btn btn-light rounded-circle shadow-sm" style="width: 40px; height: 40px; padding: 0;">
                                    <i class="fas fa-heart text-danger"></i>
                                </button>
                            </div>

                            <!-- Quick View Overlay -->
                            <div class="quick-view position-absolute bottom-0 start-0 w-100 p-3"
                                 style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); opacity: 0; transition: opacity 0.3s ease;">
                                <a href="{{ route('produk.show', $product->id) }}"
                                   class="btn btn-light btn-sm w-100"
                                   style="border-radius: 8px; font-weight: 500;">
                                    <i class="fas fa-eye me-1"></i>Lihat Detail
                                </a>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="card-body p-3 d-flex flex-column">
                            <!-- UMKM Name -->
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-store text-primary me-2" style="font-size: 0.875rem;"></i>
                                <small class="text-muted text-truncate">{{ $product->umkm->nama_usaha }}</small>
                            </div>

                            <!-- Product Name -->
                            <h6 class="card-title fw-bold mb-2 line-clamp-2" style="color: var(--primary-start); min-height: 2.8em; line-height: 1.4;">
                                {{ $product->nama_produk }}
                            </h6>

                            <!-- Category Badge -->
                            @if($product->kategori)
                            <div class="mb-2">
                                <span class="badge bg-light text-dark" style="font-size: 0.75rem; border-radius: 6px;">
                                    <i class="fas fa-tag me-1"></i>{{ $product->kategori }}
                                </span>
                            </div>
                            @endif

                            <!-- Price and Stats -->
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-bold mb-0" style="color: #10b981; font-size: 1.25rem;">
                                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                                    </h5>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-grid gap-2">
                                    <a href="{{ route('produk.show', $product->id) }}"
                                       class="btn btn-primary btn-sm"
                                       style="border-radius: 8px; padding: 0.5rem; font-weight: 500;">
                                        <i class="fas fa-shopping-cart me-1"></i>Lihat Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
            <nav aria-label="Navigasi halaman produk">
                {{ $products->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    @else
        <!-- Empty State -->
        <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 16px;" data-aos="fade-up">
            <div class="card-body p-5">
                <i class="fas fa-search fa-5x text-muted mb-4 opacity-50"></i>
                <h4 class="text-muted mb-3">Produk Tidak Ditemukan</h4>
                <p class="text-muted mb-4">Maaf, kami tidak menemukan produk yang sesuai dengan pencarian Anda.<br>Coba kata kunci lain atau hapus filter pencarian.</p>
                <a href="{{ route('produk.index') }}" class="btn btn-primary btn-lg px-5" style="border-radius: 12px;">
                    <i class="fas fa-redo me-2"></i>Reset Pencarian
                </a>
            </div>
        </div>
    @endif
</div>

<style>
/* Product Card Hover Effects */
.product-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 40px rgba(30, 58, 138, 0.15) !important;
}

.product-card:hover .product-img {
    transform: scale(1.1);
}

.product-card:hover .quick-view {
    opacity: 1;
}

/* Line Clamp */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Text Gradient */
.text-primary-gradient {
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Form Controls */
.form-control:focus,
.form-select:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 0.2rem rgba(96, 165, 250, 0.15);
}

/* Dropdown Menu */
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
    padding: 0.625rem 1rem;
}

.dropdown-item:hover {
    background: var(--primary-light);
    padding-left: 1.5rem;
}

.dropdown-item.active {
    background: var(--primary-gradient);
    color: white;
}

/* Badge Close Button */
.badge a {
    text-decoration: none;
    font-size: 1.2em;
    line-height: 1;
}

.badge a:hover {
    opacity: 0.7;
}

/* Pagination Styling */
.pagination {
    gap: 0.5rem;
}

.pagination .page-link {
    border: none;
    border-radius: 10px;
    padding: 0.625rem 1rem;
    color: var(--primary-start);
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
}

.pagination .page-item.active .page-link {
    background: var(--primary-gradient);
    box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
}

.pagination .page-item.disabled .page-link {
    background: #f3f4f6;
    color: #9ca3af;
}

/* Button Hover Effects */
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(30, 58, 138, 0.3);
}

.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
}

.btn-outline-danger:hover {
    transform: translateY(-2px);
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

/* Responsive */
@media (max-width: 768px) {
    .display-5 {
        font-size: 1.75rem;
    }

    .product-card:hover {
        transform: translateY(-8px);
    }
}
</style>

<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 600,
        easing: 'ease-in-out',
        once: true,
        offset: 50
    });
});
</script>
@endsection
