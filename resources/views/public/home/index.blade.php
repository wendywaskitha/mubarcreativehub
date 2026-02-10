@extends('public.layouts.app')

@section('title', 'Beranda - Mubar Creative Hub')

@section('content')
<!-- Hero Banner Section -->
<section class="hero-banner position-relative overflow-hidden" style="background: var(--primary-gradient); padding: 140px 0 100px;">
    <!-- Animated Background Pattern -->
    <div class="hero-pattern position-absolute w-100 h-100 top-0 start-0" style="opacity: 0.08; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    <!-- Floating Shapes -->
    <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden" style="z-index: 0;">
        <div class="position-absolute rounded-circle bg-white opacity-10 floating-shape" style="width: 300px; height: 300px; top: -100px; right: 10%; animation: float 8s ease-in-out infinite;"></div>
        <div class="position-absolute rounded-circle bg-white opacity-10 floating-shape" style="width: 200px; height: 200px; bottom: 50px; left: 5%; animation: float 6s ease-in-out infinite 2s;"></div>
    </div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="text-white">
                    <div class="badge text-white px-4 py-2 rounded-pill mb-4"
                         style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); font-weight: 500;">
                        <i class="fas fa-fire me-2"></i>Platform Pelaku Ekonomi Kreatif Digital Terpercaya
                    </div>
                    <h1 class="display-3 fw-bold mb-4 lh-sm animate-text">
                        Temukan & Dukung<br>
                        <span class="position-relative d-inline-block">
                            <span style="color: #fbbf24;">Ekonomi Kreatif</span><br>
                            <span style="color: #fbbf24; font-size: 2rem;">Muna Barat</span>
                            <svg class="position-absolute bottom-0 start-0 w-100" style="height: 12px; margin-bottom: -8px;" viewBox="0 0 200 12" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 6 Q50 0, 100 6 T200 6" stroke="#fbbf24" stroke-width="3" fill="none" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </h1>
                    <p class="lead mb-5 pe-lg-5" style="color: rgba(255,255,255,0.9); line-height: 1.8; font-size: 1.15rem;">
                        Jelajahi produk unggulan dari pelaku ekonomi kreatif Muna Barat. Mari bersama membangun ekonomi lokal yang lebih kuat dan berkelanjutan.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('umkm.index') }}" class="btn btn-light btn-lg px-5 py-3 fw-semibold rounded-pill shadow-lg">
                            <i class="fas fa-store me-2"></i>Jelajahi
                        </a>
                        {{-- <a href="{{ route('map.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-semibold rounded-pill border-2">
                            <i class="fas fa-map-marked-alt me-2"></i>Lihat di Peta
                        </a> --}}
                    </div>

                    <!-- Trust Indicators -->
                    <div class="d-flex flex-wrap gap-4 mt-5 pt-4 border-top border-white border-opacity-25">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-shield-alt fs-4" style="color: #fbbf24;"></i>
                            <div>
                                <small class="d-block opacity-75" style="font-size: 0.75rem;">100% Terverifikasi</small>
                                <strong style="font-size: 0.9rem;">Resmi</strong>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-users fs-4" style="color: #fbbf24;"></i>
                            <div>
                                <small class="d-block opacity-75" style="font-size: 0.75rem;">Didukung</small>
                                <strong style="font-size: 0.9rem;">Pemkab Mubar</strong>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-star fs-4" style="color: #fbbf24;"></i>
                            <div>
                                <small class="d-block opacity-75" style="font-size: 0.75rem;">Platform</small>
                                <strong style="font-size: 0.9rem;">Terpercaya</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="position-relative">
                    <div class="hero-image-wrapper position-relative mx-auto" style="max-width: 550px;">
                        <!-- Main Card -->
                        <div class="bg-white rounded-4 shadow-2xl p-3 position-relative" style="transform: rotate(-2deg);">
                            <div class="d-flex align-items-center justify-content-center rounded-3 overflow-hidden"
                                 style="height: 420px; background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%);">
                                <div class="text-center p-4">
                                    <div class="mb-4">
                                        <i class="fas fa-store" style="font-size: 5rem; color: var(--primary-start);"></i>
                                    </div>
                                    <h4 class="fw-bold mb-2" style="color: var(--primary-start);">Ekonomi Kreatif Muna Barat</h4>
                                    <p class="text-muted mb-0">Platform Ekonomi Kreatif Digital</p>
                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                        <div class="bg-white rounded-circle p-2 shadow-sm" style="width: 12px; height: 12px;"></div>
                                        <div class="bg-white rounded-circle p-2 shadow-sm" style="width: 12px; height: 12px; opacity: 0.5;"></div>
                                        <div class="bg-white rounded-circle p-2 shadow-sm" style="width: 12px; height: 12px; opacity: 0.5;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Badge 1 -->
                        <div class="position-absolute top-0 end-0 me-n3 mt-4 animate-float">
                            <div class="badge bg-success text-white p-3 rounded-3 shadow-lg" style="backdrop-filter: blur(10px);">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-check-circle fs-5"></i>
                                    <div class="text-start">
                                        <div class="fw-bold">Terverifikasi</div>
                                        <small style="font-size: 0.75rem;">100% Resmi</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Badge 2 -->
                        <div class="position-absolute bottom-0 start-0 ms-n3 mb-4 animate-float" style="animation-delay: 1s;">
                            <div class="bg-white text-dark p-3 rounded-3 shadow-lg">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 40px; height: 40px; background: var(--primary-light);">
                                        <i class="fas fa-chart-line" style="color: var(--primary-start);"></i>
                                    </div>
                                    <div class="text-start">
                                        <small class="d-block text-muted" style="font-size: 0.7rem;">Pertumbuhan</small>
                                        <div class="fw-bold" style="color: var(--primary-start);">+25% YoY</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Counter Section -->
<section class="stats-section" style="background: linear-gradient(to bottom, #f8fafc, #ffffff); margin-top: -60px; padding: 80px 0 60px;">
    <div class="container">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden" data-aos="fade-up" style="background: white;">
            <div class="card-body p-4 p-lg-5">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="text-center p-3 stat-item">
                            <div class="position-relative d-inline-block mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-start) 0%, var(--primary-end) 100%);">
                                    <i class="fas fa-store text-white fs-3"></i>
                                </div>
                                <div class="position-absolute top-0 end-0 rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                     style="width: 28px; height: 28px; background: #10b981;">
                                    <i class="fas fa-arrow-up text-white" style="font-size: 0.7rem;"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-1 counter" data-target="{{ \App\Models\UMKM::count() }}" style="color: var(--primary-start); font-size: 2.5rem;">0</h3>
                            <p class="text-muted mb-0 fw-semibold">Ekonomi Kreatif Terdaftar</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="text-center p-3 stat-item">
                            <div class="position-relative d-inline-block mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981 0%, #34d399 100%);">
                                    <i class="fas fa-box-open text-white fs-3"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold text-success mb-1 counter" data-target="{{ \App\Models\Produk::count() }}" style="font-size: 2.5rem;">0</h3>
                            <p class="text-muted mb-0 fw-semibold">Produk Tersedia</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="text-center p-3 stat-item">
                            <div class="position-relative d-inline-block mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 80px; height: 80px; background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);">
                                    <i class="fas fa-map-marked-alt text-white fs-3"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-1 counter" data-target="{{ \App\Models\Kecamatan::count() }}" style="color: #3b82f6; font-size: 2.5rem;">0</h3>
                            <p class="text-muted mb-0 fw-semibold">Kecamatan</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="text-center p-3 stat-item">
                            <div class="position-relative d-inline-block mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 80px; height: 80px; background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);">
                                    <i class="fas fa-tags text-white fs-3"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-1 counter" data-target="{{ \App\Models\Subsektor::count() }}" style="color: #f59e0b; font-size: 2.5rem;">0</h3>
                            <p class="text-muted mb-0 fw-semibold">Subsektor</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured UMKM Section -->
<section class="featured-umkm py-5 my-5">
    <div class="container">
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-lg-8 mx-auto text-center">
                <span class="badge px-4 py-2 rounded-pill mb-3"
                      style="background: linear-gradient(135deg, var(--primary-light) 0%, #e0e7ff 100%); color: var(--primary-start); font-weight: 500;">
                    <i class="fas fa-star me-2"></i>Pilihan Terbaik
                </span>
                <h2 class="display-5 fw-bold mb-3" style="color: var(--primary-start);">Ekonomi Kreatif Unggulan</h2>
                <p class="text-muted mb-0 lead">Temukan Ekonomi Kreatif terbaik dengan produk berkualitas tinggi di Kabupaten Muna Barat</p>
            </div>
        </div>
        <div class="row g-4">
            @forelse($featuredUmkm as $umkm)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden card-hover-lift">
                    <div class="position-relative overflow-hidden" style="height: 260px;">
                        @if($umkm->logo)
                            <img src="{{ Storage::url($umkm->logo) }}"
                                 class="card-img-top card-img-zoom w-100 h-100"
                                 alt="{{ $umkm->nama_usaha }}"
                                 style="object-fit: cover;">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                 style="background: linear-gradient(135deg, var(--primary-light) 0%, #e0e7ff 100%);">
                                <i class="fas fa-store fa-4x text-muted opacity-25"></i>
                            </div>
                        @endif
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge text-white px-3 py-2 rounded-pill shadow-sm"
                                  style="background: var(--primary-gradient); font-weight: 500;">
                                <i class="fas fa-tag me-1"></i>{{ $umkm->subsektor->nama_subsektor }}
                            </span>
                        </div>
                        <div class="position-absolute top-0 end-0 m-3">
                            <button class="btn btn-light rounded-circle shadow-sm" style="width: 42px; height: 42px; padding: 0;">
                                <i class="fas fa-heart text-danger"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3" style="color: var(--primary-start);">{{ $umkm->nama_usaha }}</h5>
                        <div class="d-flex align-items-start gap-2 mb-3">
                            <i class="fas fa-map-marker-alt text-danger mt-1"></i>
                            <small class="text-muted">{{ $umkm->desa->nama_desa }}, {{ $umkm->kecamatan->nama_kecamatan }}</small>
                        </div>
                        <p class="card-text text-muted small mb-4" style="line-height: 1.6;">{{ Str::limit($umkm->deskripsi, 100) }}</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('umkm.show', $umkm->id) }}"
                               class="btn btn-outline-primary flex-fill rounded-pill">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                            <a href="https://wa.me/{{ formatPhoneNumber($umkm->no_telp) }}?text={{ createWhatsAppMessage('Halo '.$umkm->nama_usaha.', saya ingin bertanya tentang produk Anda.') }}"
                               target="_blank"
                               class="btn btn-success flex-fill rounded-pill">
                                <i class="fab fa-whatsapp me-1"></i>Chat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 16px;">
                    <div class="card-body">
                        <i class="fas fa-store-slash fa-5x text-muted mb-4 opacity-50"></i>
                        <h5 class="text-muted mb-2">Belum Ada Ekonomi Kreatif Unggulan</h5>
                        <p class="text-muted small mb-0">Produk unggulan dari Ekonomi Kreatif terbaik akan segera hadir</p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        @if($featuredUmkm->count() > 0)
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('umkm.index') }}"
               class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">
                <i class="fas fa-th-large me-2"></i>Lihat Semua
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Categories Section -->
<section class="categories py-5 my-5" style="background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);">
    <div class="container">
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-lg-8 mx-auto text-center">
                <span class="badge bg-dark bg-opacity-75 text-white px-4 py-2 rounded-pill mb-3">
                    <i class="fas fa-th-large me-2"></i>Kategori
                </span>
                <h2 class="display-5 fw-bold mb-3" style="color: #1f2937;">Telusuri Berdasarkan Subsektor</h2>
                <p class="text-muted mb-0 lead">Temukan Ekonomi Kreatif sesuai dengan kategori yang Anda cari</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($subsektors as $subsektor)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 50 }}">
                <a href="{{ route('umkm.index', ['subsektor' => $subsektor->id]) }}" class="text-decoration-none">
                    <div class="card border-0 text-center bg-white shadow-sm rounded-4 p-4 h-100 card-hover-lift category-card">
                        <div class="category-icon mb-3 mx-auto position-relative d-flex align-items-center justify-content-center"
                             style="width: 80px; height: 80px;">
                            <div class="position-absolute w-100 h-100 rounded-circle"
                                 style="background: {{ $subsektor->color_code }}15;"></div>
                            <span class="fs-1 position-relative" style="color: {{ $subsektor->color_code }};">
                                {!! $subsektor->icon !!}
                            </span>
                        </div>
                        <h6 class="card-title fw-bold mb-2 small text-dark">{{ $subsektor->nama_subsektor }}</h6>
                        <span class="badge bg-light text-dark rounded-pill px-3 py-2 small">
                            {{ $subsektor->umkms->count() }} Ekonomi Kreatif
                        </span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Recent Blog Posts Section -->
<section class="blog-posts py-5 my-5">
    <div class="container">
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-lg-8 mx-auto text-center">
                <span class="badge px-4 py-2 rounded-pill mb-3"
                      style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af; font-weight: 500;">
                    <i class="fas fa-newspaper me-2"></i>Berita & Artikel
                </span>
                <h2 class="display-5 fw-bold mb-3" style="color: var(--primary-start);">Artikel Terbaru</h2>
                <p class="text-muted mb-0 lead">Berita dan informasi seputar perkembangan Ekonomi Kreatif di Muna Barat</p>
            </div>
        </div>
        <div class="row g-4">
            @forelse($recentArticles as $article)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden card-hover-lift">
                    <div class="position-relative overflow-hidden" style="height: 240px;">
                        @if($article->featured_image)
                            <img src="{{ Storage::url($article->featured_image) }}"
                                 class="card-img-top card-img-zoom w-100 h-100"
                                 alt="{{ $article->judul }}"
                                 style="object-fit: cover;">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                 style="background: linear-gradient(135deg, var(--primary-light) 0%, #e0e7ff 100%);">
                                <i class="fas fa-newspaper fa-4x text-muted opacity-25"></i>
                            </div>
                        @endif
                        @if($article->kategori)
                        <div class="position-absolute bottom-0 start-0 m-3">
                            <span class="badge bg-white px-3 py-2 rounded-pill shadow-sm fw-semibold"
                                  style="color: var(--primary-start);">
                                {{ $article->kategori }}
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3 lh-base" style="color: var(--primary-start);">
                            {{ Str::limit($article->judul, 60) }}
                        </h5>
                        <p class="card-text text-muted small mb-4" style="line-height: 1.6;">
                            {{ Str::limit(strip_tags($article->konten), 100) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <i class="far fa-calendar text-muted"></i>
                                <small class="text-muted">
                                    {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                </small>
                            </div>
                            <a href="{{ route('blog.show', $article->id) }}"
                               class="btn btn-sm btn-outline-primary rounded-pill px-4">
                                Baca <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 16px;">
                    <div class="card-body">
                        <i class="fas fa-newspaper fa-5x text-muted mb-4 opacity-50"></i>
                        <h5 class="text-muted mb-2">Belum Ada Artikel</h5>
                        <p class="text-muted small mb-0">Artikel dan berita terbaru akan segera hadir</p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        @if($recentArticles->count() > 0)
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('blog.index') }}"
               class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">
                <i class="fas fa-book-open me-2"></i>Baca Semua Artikel
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 my-5 position-relative overflow-hidden"
         style="background: var(--primary-gradient);">
    <div class="position-absolute w-100 h-100 top-0 start-0" style="opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center" data-aos="fade-up">
            <div class="col-lg-8 mx-auto text-center text-white">
                <i class="fas fa-rocket fa-3x mb-4 opacity-75"></i>
                <h2 class="display-5 fw-bold mb-4">Daftarkan Sekarang!</h2>
                <p class="lead mb-5 opacity-90">
                    Bergabunglah dengan ratusan Ekonomi Kreatif lainnya dan jangkau lebih banyak pelanggan melalui platform digital kami.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="#" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-semibold shadow-lg">
                        <i class="fas fa-plus-circle me-2"></i>Daftar
                    </a>
                    <a href="#" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-semibold border-2">
                        <i class="fas fa-phone me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Hero Section Enhancements */
.hero-banner {
    position: relative;
}

.animate-text {
    animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Floating Animation */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.floating-shape {
    animation: float 8s ease-in-out infinite;
}

/* Card Hover Effects */
.card-hover-lift {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.card-hover-lift:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 40px rgba(30, 58, 138, 0.15) !important;
}

.shadow-2xl {
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
}

/* Image Zoom Effect */
.card-img-zoom {
    transition: transform 0.6s ease;
}

.card:hover .card-img-zoom {
    transform: scale(1.1);
}

/* Stat Item Hover */
.stat-item {
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: scale(1.05);
}

/* Counter Animation */
.counter {
    font-variant-numeric: tabular-nums;
}

/* Category Card */
.category-card:hover .category-icon {
    animation: bounce 0.6s ease;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* Button Enhancements */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.btn-light:hover {
    background-color: #ffffff;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

.btn-outline-light:hover {
    background-color: rgba(255,255,255,0.2);
    border-color: white;
}

.btn-outline-primary:hover {
    background: var(--primary-gradient);
    border-color: transparent;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .display-3 { font-size: 2rem; }
    .display-5 { font-size: 1.75rem; }
    .lead { font-size: 1rem; }
    .hero-banner { padding: 100px 0 60px !important; }
    .py-5 { padding: 3rem 0 !important; }
    .my-5 { margin: 2rem 0 !important; }
    .counter { font-size: 2rem !important; }
    .stats-section { padding: 60px 0 40px !important; }
}

/* Smooth Scrolling */
html {
    scroll-behavior: smooth;
}

section {
    scroll-margin-top: 100px;
}
</style>

<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Counter Animation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });

    // Counter Animation
    const counters = document.querySelectorAll('.counter');

    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.ceil(current).toLocaleString('id-ID');
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target.toLocaleString('id-ID');
            }
        };

        updateCounter();
    };

    // Intersection Observer for Counter
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));
});
</script>
@endsection
