<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary-gradient shadow-sm fixed-top border-0">
    <div class="container">
        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            @if($settings['frontend_logo'])
                <img src="{{ asset('storage/' . $settings['frontend_logo']) }}" alt="{{ $settings['site_title'] ?? 'Logo' }}" width="32" height="32" class="rounded-3">
            @elseif($settings['site_logo'])
                <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_title'] ?? 'Logo' }}" width="32" height="32" class="rounded-3">
            @else
                <div class="rounded-3 bg-white d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
                    <i class="fas fa-store text-primary fs-6"></i>
                </div>
            @endif
            <div class="d-flex flex-column lh-1">
                <span class="fw-semibold">{{ $settings['site_title'] ?? 'Mubar Creative Hub' }}</span>
                <small class="text-white-50 d-none d-md-inline">{{ $settings['site_description'] ?? 'Kolaborasi, Kreativitas, Inovasi' }}</small>
            </div>
        </a>

        {{-- Toggler --}}
        <button class="navbar-toggler border-0 rounded-3 px-2 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('home')) active @endif" href="{{ route('home') }}">
                        <i class="fas fa-house me-1"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('umkm.*')) active @endif" href="{{ route('umkm.index') }}">
                        <i class="fas fa-store me-1"></i>
                        <span>Pelaku Ekraf</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('produk.*')) active @endif" href="{{ route('produk.index') }}">
                        <i class="fas fa-box-open me-1"></i>
                        <span>Produk</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('map.*')) active @endif" href="{{ route('map.index') }}">
                        <i class="fas fa-map-location-dot me-1"></i>
                        <span>Peta</span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('blog.*')) active @endif" href="{{ route('blog.index') }}">
                        <i class="fas fa-newspaper me-1"></i>
                        <span>Blog</span>
                    </a>
                </li>

                {{-- Divider --}}
                <li class="d-none d-lg-block mx-2" style="width:1px;height:24px;background:rgba(255,255,255,.25);"></li>

                {{-- Search Form --}}
                <li class="nav-item d-none d-lg-block">
                    <form action="{{ route('umkm.search') }}" method="GET" class="d-flex">
                        <input
                            class="form-control me-2 ps-4 py-2 rounded-pill"
                            type="search"
                            name="q"
                            placeholder="Cari Pelaku Ekraf..."
                            aria-label="Search"
                            value="{{ request('q') ?? '' }}"
                            style="max-width: 200px;"
                        >
                        <button class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" type="submit" style="width: 40px; height: 40px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </li>
                {{-- Mobile Search Icon --}}
                <li class="nav-item d-lg-none">
                    <a class="btn btn-sm btn-outline-light text-white d-flex align-items-center justify-content-center rounded-circle" href="#" style="width: 40px; height: 40px;" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Mobile Search Modal --}}
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="searchModalLabel">Cari Pelaku Ekraf</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form action="{{ route('umkm.search') }}" method="GET">
                    <div class="input-group">
                        <input
                            class="form-control ps-4 py-2 rounded-pill"
                            type="search"
                            name="q"
                            placeholder="Cari Pelaku Ekraf..."
                            aria-label="Search"
                            value="{{ request('q') ?? '' }}"
                        >
                        <button class="btn btn-outline-secondary rounded-pill" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
