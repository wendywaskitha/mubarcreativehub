@extends('public.layouts.app')

@section('title', $article->judul . ' - Mubar Creative Hub')

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
                        <a href="{{ route('blog.index') }}" class="text-decoration-none" style="color: var(--primary-start);">
                            Blog
                        </a>
                    </li>
                    <li class="breadcrumb-item active fw-semibold" aria-current="page">{{ Str::limit($article->judul, 40) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <!-- Article Content -->
            <article class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <!-- Featured Image -->
                <div class="position-relative" style="height: 450px; overflow: hidden;">
                    @if($article->featured_image)
                        <img src="{{ Storage::url($article->featured_image) }}"
                             class="w-100 h-100"
                             alt="{{ $article->judul }}"
                             style="object-fit: cover;">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                             style="background: linear-gradient(135deg, var(--primary-light) 0%, #e0e7ff 100%);">
                            <i class="fas fa-newspaper fa-5x text-muted opacity-25"></i>
                        </div>
                    @endif

                    <!-- Gradient Overlay -->
                    <div class="position-absolute bottom-0 start-0 end-0 p-4"
                         style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);">
                        @if($article->kategori)
                        <span class="badge mb-2 px-3 py-2"
                              style="background: var(--primary-gradient); border-radius: 8px; font-weight: 500;">
                            <i class="fas fa-tag me-1"></i>{{ $article->kategori }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Article Header -->
                <div class="card-body p-4 p-lg-5">
                    <!-- Title -->
                    <h1 class="display-5 fw-bold mb-4" style="color: var(--primary-start); line-height: 1.3;">
                        {{ $article->judul }}
                    </h1>

                    <!-- Meta Information -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-4 border-bottom">
                        <div class="d-flex flex-wrap gap-3 mb-3 mb-md-0">
                            <!-- Date -->
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                     style="width: 36px; height: 36px;">
                                    <i class="far fa-calendar" style="color: var(--primary-start);"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Dipublikasikan</small>
                                    <small class="fw-semibold text-dark">
                                        {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </div>

                            <!-- Author (if available) -->
                            @if($article->penulis)
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                     style="width: 36px; height: 36px;">
                                    <i class="far fa-user" style="color: var(--primary-start);"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Penulis</small>
                                    <small class="fw-semibold text-dark">{{ $article->penulis }}</small>
                                </div>
                            </div>
                            @endif

                            <!-- Reading Time -->
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                     style="width: 36px; height: 36px;">
                                    <i class="far fa-clock" style="color: var(--primary-start);"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Waktu Baca</small>
                                    <small class="fw-semibold text-dark">{{ ceil(str_word_count(strip_tags($article->konten)) / 200) }} menit</small>
                                </div>
                            </div>
                        </div>

                        <!-- Share Buttons -->
                        <div class="btn-group" role="group">
                            <button type="button"
                                    class="btn btn-outline-primary dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    style="border-radius: 10px; padding: 0.625rem 1.25rem; border-width: 2px; font-weight: 500;">
                                <i class="fas fa-share-alt me-2"></i>Bagikan
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow" style="border-radius: 10px; border: none; min-width: 250px;">
                                <li>
                                    <a class="dropdown-item py-2"
                                       href="https://api.whatsapp.com/send?text={{ urlencode($article->judul . ' - ' . url()->current()) }}"
                                       target="_blank">
                                        <i class="fab fa-whatsapp text-success me-2 fa-lg"></i>
                                        <span class="fw-semibold">WhatsApp</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2"
                                       href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                       target="_blank">
                                        <i class="fab fa-facebook text-primary me-2 fa-lg"></i>
                                        <span class="fw-semibold">Facebook</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2"
                                       href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($article->judul) }}"
                                       target="_blank">
                                        <i class="fab fa-twitter text-info me-2 fa-lg"></i>
                                        <span class="fw-semibold">Twitter</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-2"></li>
                                <li>
                                    <button class="dropdown-item py-2"
                                            onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link berhasil disalin!')">
                                        <i class="fas fa-copy text-secondary me-2 fa-lg"></i>
                                        <span class="fw-semibold">Salin Tautan</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="article-content" style="font-size: 1.05rem; line-height: 1.9; color: #374151;">
                        {!! $article->konten !!}
                    </div>

                    <!-- Tags (if available) -->
                    @if($article->tags)
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="fw-bold mb-3" style="color: var(--primary-start);">
                            <i class="fas fa-tags me-2"></i>Tags
                        </h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(explode(',', $article->tags) as $tag)
                            <span class="badge bg-light text-dark px-3 py-2"
                                  style="border-radius: 8px; font-weight: 500; font-size: 0.875rem;">
                                #{{ trim($tag) }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Navigation: Previous & Next Article -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="row g-3">
                            @if($previousArticle)
                            <div class="col-md-6">
                                <a href="{{ route('blog.show', $previousArticle->id) }}"
                                   class="text-decoration-none">
                                    <div class="p-3 rounded h-100"
                                         style="background: #f9fafb; transition: all 0.3s ease;"
                                         onmouseover="this.style.background='var(--primary-light)'"
                                         onmouseout="this.style.background='#f9fafb'">
                                        <small class="text-muted d-block mb-2">
                                            <i class="fas fa-arrow-left me-1"></i>Artikel Sebelumnya
                                        </small>
                                        <h6 class="fw-semibold mb-0" style="color: var(--primary-start);">
                                            {{ Str::limit($previousArticle->judul, 50) }}
                                        </h6>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @if($nextArticle)
                            <div class="col-md-6">
                                <a href="{{ route('blog.show', $nextArticle->id) }}"
                                   class="text-decoration-none">
                                    <div class="p-3 rounded h-100 text-end"
                                         style="background: #f9fafb; transition: all 0.3s ease;"
                                         onmouseover="this.style.background='var(--primary-light)'"
                                         onmouseout="this.style.background='#f9fafb'">
                                        <small class="text-muted d-block mb-2">
                                            Artikel Selanjutnya<i class="fas fa-arrow-right ms-1"></i>
                                        </small>
                                        <h6 class="fw-semibold mb-0" style="color: var(--primary-start);">
                                            {{ Str::limit($nextArticle->judul, 50) }}
                                        </h6>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </article>

            <!-- Comments Section -->
            <div class="card border-0 shadow-sm mt-4" style="border-radius: 16px;">
                <div class="card-header border-0 p-4" style="background: #f9fafb; border-radius: 16px 16px 0 0;">
                    <h2 class="h5 mb-0 fw-bold" style="color: var(--primary-start);">
                        <i class="far fa-comments me-2"></i>Komentar
                    </h2>
                </div>
                <div class="card-body p-4">
                    <div class="text-center py-5">
                        <i class="far fa-comment-dots fa-4x text-muted mb-3 opacity-50"></i>
                        <h5 class="text-muted mb-2">Komentar Segera Hadir</h5>
                        <p class="text-muted mb-0">Fitur komentar sedang dalam pengembangan dan akan segera tersedia.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Related Articles -->
            <div class="card border-0 shadow-sm mb-4 sticky-sidebar" style="border-radius: 16px; top: 90px;">
                <div class="card-header border-0 text-white p-3" style="background: var(--primary-gradient); border-radius: 16px 16px 0 0;">
                    <h2 class="h5 mb-0 fw-bold">
                        <i class="fas fa-newspaper me-2"></i>Artikel Terkait
                    </h2>
                </div>
                <div class="card-body p-3">
                    @if($relatedArticles->count() > 0)
                        @foreach($relatedArticles as $relatedArticle)
                        @if($relatedArticle->id != $article->id)
                        <a href="{{ route('blog.show', $relatedArticle->id) }}" class="text-decoration-none">
                            <div class="related-article-item d-flex align-items-start p-2 mb-3 rounded"
                                 style="transition: all 0.3s ease;"
                                 onmouseover="this.style.background='var(--primary-light)'"
                                 onmouseout="this.style.background='transparent'">
                                <!-- Thumbnail -->
                                <div class="flex-shrink-0 me-3 position-relative" style="width: 70px; height: 70px;">
                                    @if($relatedArticle->featured_image)
                                        <img src="{{ Storage::url($relatedArticle->featured_image) }}"
                                             class="rounded w-100 h-100"
                                             alt="{{ $relatedArticle->judul }}"
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
                                        {{ Str::limit($relatedArticle->judul, 45) }}
                                    </h6>
                                    <div class="d-flex align-items-center text-muted" style="font-size: 0.75rem;">
                                        <i class="far fa-calendar me-1"></i>
                                        <small>{{ $relatedArticle->published_at ? $relatedArticle->published_at->format('d M Y') : $relatedArticle->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endif
                        @endforeach
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3 opacity-50"></i>
                        <p class="text-muted mb-0 small">Tidak ada artikel terkait</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Back to Blog -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-body p-4 text-center">
                    <i class="fas fa-arrow-left fa-2x mb-3" style="color: var(--primary-start);"></i>
                    <h5 class="fw-bold mb-3" style="color: var(--primary-start);">Jelajahi Artikel Lainnya</h5>
                    <p class="text-muted mb-4">Temukan lebih banyak artikel menarik seputar UMKM</p>
                    <a href="{{ route('blog.index') }}"
                       class="btn btn-primary w-100"
                       style="border-radius: 10px; padding: 0.75rem; font-weight: 500;">
                        <i class="fas fa-th-large me-2"></i>Lihat Semua Artikel
                    </a>
                </div>
            </div>

            <!-- Newsletter Signup -->
            <div class="card border-0 shadow-sm"
                 style="border-radius: 16px; background: linear-gradient(135deg, var(--primary-start) 0%, var(--primary-end) 100%);">
                <div class="card-body p-4 text-white text-center">
                    <i class="fas fa-envelope-open-text fa-3x mb-3 opacity-75"></i>
                    <h5 class="fw-bold mb-2">Berlangganan Newsletter</h5>
                    <p class="small mb-4 opacity-90">Dapatkan artikel terbaru langsung ke email Anda setiap minggu</p>
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <input type="email"
                                   class="form-control form-control-lg"
                                   placeholder="Alamat Email Anda"
                                   required
                                   style="border-radius: 10px; border: 2px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.2); color: white; text-align: center;"
                                   onfocus="this.style.background='rgba(255,255,255,0.3)'"
                                   onblur="this.style.background='rgba(255,255,255,0.2)'">
                        </div>
                        <button type="submit"
                                class="btn btn-light w-100"
                                style="border-radius: 10px; padding: 0.75rem; font-weight: 600; color: var(--primary-start);">
                            <i class="fas fa-paper-plane me-2"></i>Subscribe Sekarang
                        </button>
                    </form>
                    <small class="d-block mt-3 opacity-75">
                        <i class="fas fa-shield-alt me-1"></i>Privasi Anda terjamin
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Article Content Styling */
.article-content {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}

.article-content h2 {
    color: var(--primary-start);
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-size: 1.75rem;
}

.article-content h3 {
    color: var(--primary-start);
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.875rem;
    font-size: 1.5rem;
}

.article-content p {
    margin-bottom: 1.25rem;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 1.5rem 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.article-content ul,
.article-content ol {
    margin-bottom: 1.25rem;
    padding-left: 2rem;
}

.article-content li {
    margin-bottom: 0.5rem;
}

.article-content blockquote {
    border-left: 4px solid var(--primary-start);
    padding-left: 1.5rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6b7280;
    background: #f9fafb;
    padding: 1rem 1.5rem;
    border-radius: 0 8px 8px 0;
}

.article-content a {
    color: var(--primary-start);
    text-decoration: underline;
    transition: color 0.3s ease;
}

.article-content a:hover {
    color: var(--primary-end);
}

.article-content code {
    background: #f3f4f6;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.9em;
    color: #dc2626;
}

.article-content pre {
    background: #1f2937;
    color: #f9fafb;
    padding: 1rem;
    border-radius: 8px;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.article-content pre code {
    background: transparent;
    color: #f9fafb;
    padding: 0;
}

/* Breadcrumb */
.breadcrumb-item + .breadcrumb-item::before {
    color: #9ca3af;
}

.breadcrumb-item.active {
    color: #6b7280;
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

/* Related Article Items */
.related-article-item {
    cursor: pointer;
}

/* Sticky Sidebar */
.sticky-sidebar {
    position: sticky;
    max-height: calc(100vh - 120px);
    overflow-y: auto;
}

.sticky-sidebar::-webkit-scrollbar {
    width: 4px;
}

.sticky-sidebar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.sticky-sidebar::-webkit-scrollbar-thumb {
    background: var(--primary-medium);
    border-radius: 10px;
}

/* Newsletter Input */
input::placeholder {
    color: rgba(255, 255, 255, 0.8) !important;
}

/* Button Hover Effects */
.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
}

.btn-light:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* Navigation Cards Hover */
.row a .rounded:hover {
    transform: translateX(5px);
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
@media (max-width: 991.98px) {
    .sticky-sidebar {
        position: relative;
        max-height: none;
    }

    .article-content {
        font-size: 1rem;
    }
}
</style>
@endsection
