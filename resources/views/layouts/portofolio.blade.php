<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portofolio digital, CV, layanan website, dan training Ibrahim.">
    <title>@yield('title', 'Ibrahim - Web Developer')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/halaman_portofolio/gaya_utama.css') }}">
    <link rel="stylesheet" href="{{ asset('css/halaman_portofolio/gaya_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/halaman_portofolio/gaya_sidebar.css') }}">
    @yield('styles')
</head>
<body>
    @include('partials.portofolio.sidebar')
    <div class="area-konten">
        @include('partials.portofolio.header')
        <main>@yield('content')</main>
        @include('partials.portofolio.footer')
    </div>
    <script>
        document.querySelectorAll('[data-carousel]').forEach(function (carousel) {
            var track = carousel.querySelector('.carousel-track');
            carousel.querySelector('[data-prev]').addEventListener('click', function () { track.scrollBy({ left: -track.clientWidth * 0.7, behavior: 'smooth' }); });
            carousel.querySelector('[data-next]').addEventListener('click', function () { track.scrollBy({ left: track.clientWidth * 0.7, behavior: 'smooth' }); });
        });
    </script>
    @yield('scripts')
</body>
</html>
