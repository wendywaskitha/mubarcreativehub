@extends('public.layouts.app')

@section('title', 'Blog - Mubar Creative Hub')

@section('content')
<div class="container py-5">
    <!-- Hero Header -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary-gradient mb-3">
                <i class="fas fa-newspaper me-2"></i>Blog & Artikel
            </h1>
            <p class="lead text-muted">Informasi, tips, dan berita seputar UMKM Muna Barat</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Articles List -->
        <div class="col-lg-8">
            @forelse($articles as $article)
            <article class="card border-0 shadow-sm mb-4 article-card" style="border-radius: 16px; overflow: hidden;">
                <!-- Featured Image -->
                <div class="position-relative article-image-container" style="height: 320px; overflow: hidden;">
                    @if($article->featured_image)
                        <img src="{{ Storage::url($article->featured_image) }}"
                             class="card-img-top w-100 h-100"
                             alt="{{ $article->judul }}"
                             style="object-fit: cover; transition: transform 0.5s ease;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                             style="background: linear-gradient(135deg, var(--primary-light) 0%, #e0e7ff 100%);">
                            <i class="fas fa-newspaper fa-5x text-muted opacity-25"></i>
                        </div>
                    @endif

                    <!-- Category Badge -->
                    @if($article->kategori)
                    <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2"
                          style="background: var(--primary-gradient); backdrop-filter: blur(10px); border-radius: 8px; font-weight: 500;">
                        <i class="fas fa-tag me-1"></i>{{ $article->kategori }}
                    </span>
                    @endif

                    <!-- Reading Time Badge -->
                    <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2"
                          style="background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(10px); border-radius: 8px; font-weight: 500;">
                        <i class="far fa-clock me-1"></i>{{ ceil(str_word_count(strip_tags($article->konten)) / 200) }} min baca
                    </span>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <!-- Meta Info -->
                    <div class="d-flex align-items-center mb-3 text-muted small">
                        <div class="d-flex align-items-center me-3">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                 style="width: 28px; height: 28px;">
                                <i class="far fa-calendar" style="font-size: 0.75rem; color: var(--primary-start);"></i>
                            </div>
                            <span>{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                        </div>

                        @if($article->penulis)
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                 style="width: 28px; height: 28px;">
                                <i class="far fa-user" style="font-size: 0.75rem; color: var(--primary-start);"></i>
                            </div>
                            <span>{{ $article->penulis }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Title -->
                    <h2 class="card-title h4 fw-bold mb-3">
                        <a href="{{ route('blog.show', $article->id) }}"
                           class="text-decoration-none text-dark hover-title"
                           style="transition: color 0.3s ease;"
                           onmouseover="this.style.color='var(--primary-start)'"
                           onmouseout="this.style.color=''">
                            {{ $article->judul }}
                        </a>
                    </h2>

                    <!-- Excerpt -->
                    <p class="card-text text-muted mb-4" style="line-height: 1.8;">
                        {{ Str::limit(strip_tags($article->konten), 180) }}
                    </p>

                    <!-- Read More Button -->
                    <a href="{{ route('blog.show', $article->id) }}"
                       class="btn btn-primary"
                       style="border-radius: 10px; padding: 0.625rem 1.5rem; font-weight: 500;">
                        <i class="fas fa-book-open me-2"></i>Baca Selengkapnya
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </article>
            @empty
            <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 16px;">
                <div class="card-body">
                    <i class="fas fa-newspaper fa-5x text-muted mb-4 opacity-50"></i>
                    <h4 class="text-muted mb-2">Belum Ada Artikel</h4>
                    <p class="text-muted mb-0">Artikel dan berita terbaru akan segera hadir.</p>
                </div>
            </div>
            @endforelse

            <!-- Pagination -->
            @if($articles->hasPages())
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Navigasi halaman blog">
                    {{ $articles->links('pagination::bootstrap-5') }}
                </nav>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Search Box -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3" style="color: var(--primary-start);">
                        <i class="fas fa-search me-2"></i>Cari Artikel
                    </h5>
                    <form action="{{ route('blog.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Cari artikel..."
                                   value="{{ request('search') }}"
                                   style="border-radius: 10px 0 0 10px; border: 2px solid #e5e7eb; border-right: none;">
                            <button class="btn btn-primary"
                                    type="submit"
                                    style="border-radius: 0 10px 10px 0;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-header border-0 text-white p-3" style="background: var(--primary-gradient); border-radius: 16px 16px 0 0;">
                    <h2 class="h5 mb-0 fw-bold">
                        <i class="fas fa-folder me-2"></i>Kategori
                    </h2>
                </div>
                <div class="card-body p-3">
                    @if(count($categories) > 0)
                        <div class="d-flex flex-column gap-2">
                            @foreach($categories as $category => $count)
                            <a href="{{ route('blog.index', ['kategori' => $category]) }}"
                               class="text-decoration-none">
                                <div class="category-item d-flex justify-content-between align-items-center p-3 rounded"
                                     style="background: #f9fafb; transition: all 0.3s ease;"
                                     onmouseover="this.style.background='var(--primary-light)'; this.style.transform='translateX(5px)'"
                                     onmouseout="this.style.background='#f9fafb'; this.style.transform='translateX(0)'">
                                    <span class="fw-semibold text-dark">
                                        <i class="fas fa-chevron-right me-2" style="font-size: 0.75rem; color: var(--primary-start);"></i>
                                        {{ $category }}
                                    </span>
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background: var(--primary-gradient); font-weight: 500;">
                                        {{ $count }}
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-muted small mb-0 py-3">Belum ada kategori</p>
                    @endif
                </div>
            </div>

            <!-- Recent Articles -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-header border-0 text-white p-3" style="background: var(--primary-gradient); border-radius: 16px 16px 0 0;">
                    <h2 class="h5 mb-0 fw-bold">
                        <i class="fas fa-clock me-2"></i>Artikel Terbaru
                    </h2>
                </div>
                <div class="card-body p-3">
                    @if($recentArticles->count() > 0)
                        @foreach($recentArticles as $recentArticle)
                        <a href="{{ route('blog.show', $recentArticle->id) }}" class="text-decoration-none">
                            <div class="recent-article-item d-flex align-items-start p-2 mb-3 rounded"
                                 style="transition: all 0.3s ease;"
                                 onmouseover="this.style.background='var(--primary-light)'"
                                 onmouseout="this.style.background='transparent'">
                                <!-- Thumbnail -->
                                <div class="flex-shrink-0 me-3 position-relative" style="width: 70px; height: 70px;">
                                    @if($recentArticle->featured_image)
                                        <img src="{{ Storage::url($recentArticle->featured_image) }}"
                                             class="rounded w-100 h-100"
                                             alt="{{ $recentArticle->judul }}"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="rounded w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                            <i class="fas fa-newspaper text-muted"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-semibold" style="color: var(--primary-start); font-size: 0.9rem; line-height: 1.4;">
                                        {{ Str::limit($recentArticle->judul, 45) }}
                                    </h6>
                                    <div class="d-flex align-items-center text-muted" style="font-size: 0.75rem;">
                                        <i class="far fa-calendar me-1"></i>
                                        <small>{{ $recentArticle->published_at ? $recentArticle->published_at->format('d M Y') : $recentArticle->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    @else
                        <p class="text-center text-muted small mb-0 py-3">Belum ada artikel terbaru</p>
                    @endif
                </div>
            </div>

            <!-- Newsletter Subscribe (Optional) -->
            <div class="card border-0 shadow-sm mt-4"
                 style="border-radius: 16px; background: linear-gradient(135deg, var(--primary-start) 0%, var(--primary-end) 100%);">
                <div class="card-body p-4 text-white text-center">
                    <i class="fas fa-envelope fa-3x mb-3 opacity-75"></i>
                    <h5 class="fw-bold mb-2">Berlangganan Newsletter</h5>
                    <p class="small mb-3 opacity-90">Dapatkan update artikel terbaru langsung ke email Anda</p>
                    <form action="#" method="POST" class="mb-0">
                        <div class="input-group mb-2">
                            <input type="email"
                                   class="form-control"
                                   placeholder="Email Anda"
                                   required
                                   style="border-radius: 10px 0 0 10px; border: 2px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.2); color: white;"
                                   onfocus="this.style.background='rgba(255,255,255,0.3)'"
                                   onblur="this.style.background='rgba(255,255,255,0.2)'">
                            <button class="btn btn-light"
                                    type="submit"
                                    style="border-radius: 0 10px 10px 0; font-weight: 500; color: var(--primary-start);">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                    <small class="opacity-75">Kami tidak akan spam email Anda</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Article Card Animations */
.article-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeInUp 0.6s ease;
}

.article-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 28px rgba(30, 58, 138, 0.15) !important;
}

/* Image Container */
.article-image-container {
    position: relative;
}

.article-image-container::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 40%;
    background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.article-card:hover .article-image-container::after {
    opacity: 1;
}

/* Badge animations */
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

/* Category Items */
.category-item {
    cursor: pointer;
}

/* Recent Article Items */
.recent-article-item {
    cursor: pointer;
}


/* Search Input Focus */
.input-group .form-control:focus {
    border-color: var(--accent-color);
    box-shadow: none;
    z-index: 3;
}

/* Newsletter Input Placeholder */
.card-body input::placeholder {
    color: rgba(255, 255, 255, 0.8);
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

/* Responsive adjustments */
@media (max-width: 991.98px) {
    .sticky-sidebar {
        position: relative;
        max-height: none;
    }

    .article-image-container {
        height: 220px !important;
    }
}

/* Entrance Animation */
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

/* Button Hover Effects */
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(30, 58, 138, 0.3);
}

/* Newsletter Button Hover */
.btn-light:hover {
    transform: scale(1.05);
}
</style>
@endsection
