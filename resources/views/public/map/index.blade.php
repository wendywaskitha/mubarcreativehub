@extends('public.layouts.app')

@section('title', 'Peta UMKM - Mubar Creative Hub')

@section('content')
<div class="container-fluid py-4">
    <!-- Hero Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center mb-4">
                <h1 class="display-5 fw-bold text-primary-gradient mb-2">
                    <i class="fas fa-map-marked-alt me-2"></i>Peta Interaktif Ekonomi Kreatif
                </h1>
                <p class="lead text-muted">Jelajahi lokasi Ekonomi Kreatif di Muna Barat secara interaktif</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Sidebar for filters -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm sticky-sidebar" style="border-radius: 16px; top: 90px;">
                <div class="card-header border-0 text-white p-4" style="background: var(--primary-gradient); border-radius: 16px 16px 0 0;">
                    <h2 class="h5 mb-0 fw-bold">
                        <i class="fas fa-filter me-2"></i>Filter & Pencarian
                    </h2>
                </div>
                <div class="card-body p-4">
                    <!-- Search Input -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="fas fa-search me-1"></i>Cari Ekonomi Kreatif
                        </label>
                        <div class="position-relative">
                            <input type="text"
                                   class="form-control ps-4"
                                   id="search-umkm"
                                   placeholder="Ketik nama Pelaku Ekraf..."
                                   style="border-radius: 10px; border: 2px solid #e5e7eb;">
                            <i class="fas fa-search position-absolute text-muted"
                               style="left: 14px; top: 50%; transform: translateY(-50%); font-size: 0.875rem;"></i>
                        </div>
                    </div>

                    <!-- Kecamatan Filter -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="fas fa-map-marker-alt me-1"></i>Kecamatan
                        </label>
                        <select class="form-select"
                                id="filter-kecamatan"
                                style="border-radius: 10px; border: 2px solid #e5e7eb;">
                            <option value="">Semua Kecamatan</option>
                            @foreach($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subsektor Filter -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small mb-2">
                            <i class="fas fa-tag me-1"></i>Subsektor
                        </label>
                        <select class="form-select"
                                id="filter-subsektor"
                                style="border-radius: 10px; border: 2px solid #e5e7eb;">
                            <option value="">Semua Subsektor</option>
                            @foreach($subsektors as $subsektor)
                            <option value="{{ $subsektor->id }}">{{ $subsektor->nama_subsektor }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location Button -->
                    <div class="mb-4">
                        <button class="btn btn-primary w-100"
                                id="locate-me"
                                style="border-radius: 10px; padding: 0.75rem; font-weight: 500;">
                            <i class="fas fa-location-arrow me-2"></i>Lokasi Saya
                        </button>
                    </div>

                    <!-- Statistics Card -->
                    <div class="mb-4 p-3"
                         style="background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%); border-radius: 12px;">
                        <div class="d-flex align-items-center mb-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width: 40px; height: 40px; background: white;">
                                <i class="fas fa-store" style="color: var(--primary-start);"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Total Ekonomi Kreatif</small>
                                <h4 class="mb-0 fw-bold" style="color: var(--primary-start);" id="total-umkm">
                                    {{ count($umkmsWithLocation) }}
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Legend Section -->
                    <div class="mt-4 pt-4 border-top">
                        <h5 class="fw-bold mb-3" style="color: var(--primary-start); font-size: 0.95rem;">
                            <i class="fas fa-info-circle me-2"></i>Legenda Peta
                        </h5>
                        <div class="d-flex flex-column gap-2">
                            @foreach($subsektors as $subsektor)
                            <div class="legend-item p-2 rounded d-flex align-items-center"
                                 style="background: #f9fafb; transition: all 0.3s ease;"
                                 onmouseover="this.style.background='var(--primary-light)'"
                                 onmouseout="this.style.background='#f9fafb'">
                                <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                      style="width: 32px; height: 32px; background: white; font-size: 1.125rem; color: {{ $subsektor->color_code }}; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    {!! $subsektor->icon !!}
                                </span>
                                <small class="fw-semibold text-dark">{{ $subsektor->nama_subsektor }}</small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Container -->
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <div id="map" class="map-container" style="height: 700px; border-radius: 16px;"></div>

                <!-- Map Controls Overlay -->
                <div class="position-absolute top-0 end-0 m-3" style="z-index: 1000;">
                    <div class="btn-group-vertical shadow-sm" role="group">
                        <button type="button"
                                class="btn btn-light border-0"
                                id="zoom-in"
                                style="border-radius: 8px 8px 0 0; padding: 0.5rem 0.75rem;"
                                title="Zoom In">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button"
                                class="btn btn-light border-0 border-top"
                                id="zoom-out"
                                style="border-radius: 0 0 8px 8px; padding: 0.5rem 0.75rem;"
                                title="Zoom Out">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <!-- Map Loading Indicator -->
                <div id="map-loading"
                     class="position-absolute top-50 start-50 translate-middle text-center"
                     style="z-index: 999; display: none;">
                    <div class="spinner-border" style="color: var(--primary-start);" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 fw-semibold" style="color: var(--primary-start);">Memuat peta...</p>
                </div>
            </div>

            <!-- Map Instructions -->
            <div class="card border-0 shadow-sm mt-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3" style="color: var(--primary-start);">
                        <i class="fas fa-question-circle me-2"></i>Cara Menggunakan Peta
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="d-flex align-items-start">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 36px; height: 36px; background: var(--primary-light); flex-shrink: 0;">
                                    <i class="fas fa-mouse-pointer" style="color: var(--primary-start); font-size: 0.875rem;"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Klik Marker</h6>
                                    <small class="text-muted">Klik pada ikon di peta untuk melihat detail Ekonomi Kreatif</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-start">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 36px; height: 36px; background: var(--primary-light); flex-shrink: 0;">
                                    <i class="fas fa-filter" style="color: var(--primary-start); font-size: 0.875rem;"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Filter Data</h6>
                                    <small class="text-muted">Gunakan filter di sidebar untuk menyaring Ekonomi Kreatif</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-start">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 36px; height: 36px; background: var(--primary-light); flex-shrink: 0;">
                                    <i class="fas fa-search-location" style="color: var(--primary-start); font-size: 0.875rem;"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Cari Lokasi</h6>
                                    <small class="text-muted">Gunakan "Lokasi Saya" untuk menemukan Ekonomi Kreatif terdekat</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Wait for DOM to be loaded and Leaflet to be available
    document.addEventListener('DOMContentLoaded', function() {
        // Function to format phone number for WhatsApp
        function formatPhoneNumber(phone) {
            let formattedPhone = phone.replace(/\D/g, '');

            if (formattedPhone.startsWith('08')) {
                formattedPhone = '62' + formattedPhone.substring(1);
            } else if (formattedPhone.startsWith('8') && formattedPhone.length >= 10) {
                formattedPhone = '62' + formattedPhone;
            }

            return formattedPhone;
        }

        // Show loading indicator
        document.getElementById('map-loading').style.display = 'block';

        // Initialize the map
        const map = window.L.map('map').setView([-5.15, 122.75], 11);

        // Add OpenStreetMap tile layer
        window.L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        // Hide loading indicator after map loads
        map.whenReady(function() {
            setTimeout(() => {
                document.getElementById('map-loading').style.display = 'none';
            }, 500);
        });

        // Add markers from the data passed from the controller
        const umkmData = @json($umkmsWithLocation);
        let allMarkers = [];

        // Initialize markers variable
        let markers;

        // Check if marker cluster plugin is loaded
        if (window.L.markerClusterGroup) {
            // Create a marker cluster group
            markers = window.L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: false,
                zoomToBoundsOnClick: true,
                maxClusterRadius: 50
            });
        } else {
            console.error('Leaflet.markercluster plugin is not loaded!');
            // Fallback to regular layer group if plugin is not available
            markers = window.L.layerGroup();
            console.warn('Using regular layer group instead of marker clusters.');
        }

        umkmData.forEach(umkm => {
            // Ensure coordinates are valid numbers before creating markers
            const lat = parseFloat(umkm.latitude);
            const lng = parseFloat(umkm.longitude);

            if(!isNaN(lat) && !isNaN(lng) && lat !== 0 && lng !== 0) {
                // Create standard custom icon
                const icon = window.L.divIcon({
                    className: 'custom-marker-icon',
                    html: `<div style="background: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border: 3px solid #3b82f6;">
                            <span style="font-size: 1.25rem;">📍</span>
                           </div>`,
                    iconSize: [40, 40],
                    iconAnchor: [20, 40],
                    popupAnchor: [0, -40]
                });

                const marker = window.L.marker(
                    [lat, lng],
                    {
                        icon: icon,
                        umkmData: umkm // Store data for filtering
                    }
                );

                var popupContent = `
                    <div class="modern-popup" style="min-width: 280px;">
                        <div class="popup-header p-3" style="background: var(--primary-gradient); border-radius: 8px 8px 0 0;">
                            <div class="d-flex align-items-center text-white">
                                <span style="font-size: 1.5rem; margin-right: 12px;">📍</span>
                                <div>
                                    <h6 class="mb-1 fw-bold">${umkm.nama_usaha || 'Nama Usaha Tidak Diketahui'}</h6>
                                    <small class="badge bg-white text-primary" style="font-weight: 500;">
                                        Subsektor Tidak Diketahui
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="popup-body p-3">
                            <div class="mb-2">
                                <small class="text-muted d-flex align-items-center">
                                    <i class="fas fa-user me-2" style="width: 16px;"></i>
                                    <span>${umkm.nama_pemilik || 'Nama Pemilik Tidak Diketahui'}</span>
                                </small>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt me-2" style="width: 16px;"></i>
                                    <span>${umkm.desa?.nama_desa || 'Desa Tidak Diketahui'}, ${umkm.kecamatan?.nama_kecamatan || 'Kecamatan Tidak Diketahui'}</span>
                                </small>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="/umkm/${umkm.id || ''}"
                                   class="btn btn-light btn-sm"
                                   style="border-radius: 8px; font-weight: 500; color: var(--primary-start);">
                                    <i class="fas fa-eye me-1"></i> Lihat Detail
                                </a>
                                <a href="https://wa.me/${formatPhoneNumber(umkm.no_telp || '')}?text=${encodeURIComponent("Halo "+(umkm.nama_usaha || 'UMKM')+", saya ingin bertanya tentang produk Anda.")}"
                                   target="_blank"
                                   class="btn btn-light btn-sm"
                                   style="border-radius: 8px; font-weight: 500; color: #25d366; border-color: #25d366;">
                                    <i class="fab fa-whatsapp me-1"></i> Chat WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                `;

                marker.bindPopup(popupContent, {
                    maxWidth: 300,
                    className: 'modern-popup-wrapper'
                });

                allMarkers.push(marker);
            }
        });

        // Add all markers to the group at once
        if (window.L.markerClusterGroup && typeof markers.addLayers === 'function') {
            // Using marker cluster group
            markers.addLayers(allMarkers);
        } else {
            // Using regular layer group - add each marker individually
            allMarkers.forEach(marker => {
                marker.addTo(markers);
            });
        }

        // Add the marker group to the map
        map.addLayer(markers);

        // Update total count
        document.getElementById('total-umkm').textContent = allMarkers.length;

        // Custom zoom controls
        document.getElementById('zoom-in').addEventListener('click', function() {
            map.zoomIn();
        });

        document.getElementById('zoom-out').addEventListener('click', function() {
            map.zoomOut();
        });

        // Filter functionality with live filtering
        function filterMarkers() {
            const kecamatanId = document.getElementById('filter-kecamatan').value;
            const subsektorId = document.getElementById('filter-subsektor').value;
            const searchText = document.getElementById('search-umkm').value.toLowerCase();

            // Clear the existing markers depending on the type
            if (window.L.markerClusterGroup && typeof markers.clearLayers === 'function') {
                // Using marker cluster group
                markers.clearLayers();
            } else {
                // Using regular layer group - remove each marker individually
                allMarkers.forEach(marker => {
                    map.removeLayer(marker);
                });
            }

            let filteredMarkers = [];

            allMarkers.forEach(marker => {
                const umkm = marker.options.umkmData;

                // Check if the marker should be shown based on filters
                // Convert IDs to numbers for proper comparison if they are stored as integers
                const matchesKecamatan = !kecamatanId || parseInt(umkm.kecamatan_id) == parseInt(kecamatanId);
                const matchesSubsektor = !subsektorId || parseInt(umkm.subsektor_id) == parseInt(subsektorId);
                const matchesSearch = !searchText || umkm.nama_usaha.toLowerCase().includes(searchText);

                if (matchesKecamatan && matchesSubsektor && matchesSearch) {
                    filteredMarkers.push(marker);
                }
            });

            // Add the filtered markers to the group
            if (window.L.markerClusterGroup && typeof markers.addLayers === 'function') {
                // Using marker cluster group
                markers.addLayers(filteredMarkers);
            } else {
                // Using regular layer group - add each marker individually
                filteredMarkers.forEach(marker => {
                    marker.addTo(map);
                });
            }

            // Update the total count
            document.getElementById('total-umkm').textContent = filteredMarkers.length;
        }

        document.getElementById('filter-kecamatan').addEventListener('change', filterMarkers);
        document.getElementById('filter-subsektor').addEventListener('change', filterMarkers);
        document.getElementById('search-umkm').addEventListener('input', filterMarkers);

        // Locate me functionality
        let userMarker = null;
        document.getElementById('locate-me').addEventListener('click', function() {
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mencari lokasi...';

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    if (userMarker) {
                        map.removeLayer(userMarker);
                    }

                    const userIcon = window.L.divIcon({
                        className: 'user-location-icon',
                        html: '<div style="width: 20px; height: 20px; background: #3b82f6; border: 3px solid white; border-radius: 50%; box-shadow: 0 0 0 2px #3b82f6;"></div>',
                        iconSize: [20, 20],
                        iconAnchor: [10, 10]
                    });

                    userMarker = window.L.marker([position.coords.latitude, position.coords.longitude], { icon: userIcon })
                        .addTo(map)
                        .bindPopup('<div class="text-center p-2"><strong>Lokasi Anda</strong></div>')
                        .openPopup();

                    map.setView([position.coords.latitude, position.coords.longitude], 13);

                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-location-arrow me-2"></i>Lokasi Saya';
                }, function(error) {
                    alert('Tidak dapat mendapatkan lokasi Anda. Pastikan GPS aktif dan izin lokasi diberikan.');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-location-arrow me-2"></i>Lokasi Saya';
                });
            } else {
                alert('Geolocation tidak didukung oleh browser ini.');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-location-arrow me-2"></i>Lokasi Saya';
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Custom marker styling */
    .custom-marker-icon {
        background: none !important;
        border: none !important;
        box-shadow: none !important;
    }

    /* Modern popup styling */
    .modern-popup-wrapper .leaflet-popup-content-wrapper {
        padding: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .modern-popup-wrapper .leaflet-popup-content {
        margin: 0;
        width: auto !important;
    }

    .modern-popup-wrapper .leaflet-popup-tip {
        background: white;
    }

    /* Marker cluster styling */
    .marker-cluster-small,
    .marker-cluster-medium,
    .marker-cluster-large {
        background: var(--primary-gradient) !important;
    }

    .marker-cluster-small div,
    .marker-cluster-medium div,
    .marker-cluster-large div {
        background: rgba(255, 255, 255, 0.9);
        color: var(--primary-start);
        font-weight: 700;
    }

    /* Sticky sidebar */
    .sticky-sidebar {
        position: sticky;
        max-height: calc(100vh - 120px);
        overflow-y: auto;
    }

    .sticky-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sticky-sidebar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .sticky-sidebar::-webkit-scrollbar-thumb {
        background: var(--primary-medium);
        border-radius: 10px;
    }

    /* Form controls focus */
    .form-control:focus,
    .form-select:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.2rem rgba(96, 165, 250, 0.15);
    }

    /* Legend item hover */
    .legend-item {
        cursor: default;
    }

    /* Map controls styling */
    #zoom-in:hover,
    #zoom-out:hover {
        background: var(--primary-light) !important;
        color: var(--primary-start) !important;
    }

    /* User location pulse animation */
    .user-location-icon {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
        100% {
            opacity: 1;
        }
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .sticky-sidebar {
            position: relative;
            max-height: none;
        }

        #map {
            height: 500px !important;
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
@endpush
@endsection
