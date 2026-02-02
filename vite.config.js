import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',       // Tailwind for Filament admin
                'resources/css/bootstrap.css', // Bootstrap for public site
                'resources/css/leaflet.css',
                'node_modules/leaflet.markercluster/dist/MarkerCluster.css',
                'node_modules/leaflet.markercluster/dist/MarkerCluster.Default.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
