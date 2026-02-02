import './bootstrap';
import * as L from 'leaflet';
import 'leaflet.markercluster';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// Fix for default icon when using Vite
delete L.Icon.Default.prototype._getIconUrl;

// Set the correct paths for Leaflet marker icons
L.Icon.Default.mergeOptions({
    iconRetinaUrl: '/vendor/leaflet/dist/images/marker-icon-2x.png',
    iconUrl: '/vendor/leaflet/dist/images/marker-icon.png',
    shadowUrl: '/vendor/leaflet/dist/images/marker-shadow.png',
});

window.L = L;
