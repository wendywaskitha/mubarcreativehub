<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings['site_title'] ?? 'Mubar Creative Hub - Pusat Kreativitas Ekonomi Kreatif Muna Barat')</title>

    <!-- Favicon -->
    @if($settings['site_favicon'])
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings['site_favicon']) }}">
    @else
        <link rel="icon" type="image/x-icon" href="/favicon.ico">
    @endif

    <!-- Scripts loaded via Vite -->
    @vite(['resources/css/app.css', 'resources/css/bootstrap.css', 'resources/css/leaflet.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @stack('styles')
</head>

<body>
    @include('public.partials.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @include('public.partials.footer')

    @stack('scripts')
</body>

</html>
