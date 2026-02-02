@php
    $latitude = $getRecord()?->latitude;
    $longitude = $getRecord()?->longitude;
    $namaUsaha = $getRecord()?->nama_usaha ?? 'Lokasi UMKM';
    $mapId = 'map-preview-' . ($getRecord()?->id ?? 'unknown');
@endphp

<div class="map-container">
    @if($latitude && $longitude)
        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
            <div id="{{ $mapId }}" style="height: 200px; width: 100%; border-radius: 8px;"></div>
            <div class="mt-2 text-sm text-gray-600">
                <p><strong>Koordinat:</strong> {{ $latitude }}, {{ $longitude }}</p>
                <a href="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}"
                   target="_blank"
                   class="text-blue-600 hover:underline mt-1 inline-block">
                    🗺️ Lihat di Google Maps
                </a>
            </div>
        </div>

        <script>
        // Check if Leaflet is available and initialize the map
        document.addEventListener('DOMContentLoaded', function() {
            // Small delay to ensure DOM is fully rendered
            setTimeout(function() {
                initializeMapIfNeeded();
            }, 100);
        });

        // For dynamic content (like modals), we might need to initialize later
        function initializeMapIfNeeded() {
            if (typeof L !== 'undefined' && document.getElementById('{{ $mapId }}')) {
                const mapDiv = document.getElementById('{{ $mapId }}');
                if(mapDiv && !mapDiv.querySelector('.leaflet-container')) {
                    const map = L.map(mapDiv).setView([{{ $latitude }}, {{ $longitude }}], 15);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    L.marker([{{ $latitude }}, {{ $longitude }}]).addTo(map)
                      .bindPopup('{{ addslashes($namaUsaha) }}')
                      .openPopup();
                }
            }
        }

        // Call the function immediately in case DOM is already loaded
        if (document.readyState === 'loading') {
            // Loading hasn't finished yet
        } else {
            // DOM is already loaded
            setTimeout(function() {
                initializeMapIfNeeded();
            }, 100);
        }
        </script>
    @else
        <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
            <p class="text-sm text-yellow-800">📍 Lokasi belum ditentukan</p>
        </div>
    @endif
</div>

<style>
.map-container img {
    max-width: none !important;
}
</style>