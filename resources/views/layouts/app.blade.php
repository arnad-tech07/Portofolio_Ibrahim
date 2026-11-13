<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ibrahim - Portofolio Digital, Jasa Website & Training Pemrograman')</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="Portofolio Digital Ibrahim - Full Stack Web Developer & Trainer. Melayani Jasa Pembuatan Website Profesional & Training Pemrograman Intensif.">
    <meta name="keywords" content="Portofolio Ibrahim, Jasa Pembuatan Website, Training Laravel, Kursus Web Programming, Fullstack Developer Indonesia">
    <meta name="author" content="Ibrahim">

    <!-- Google Fonts & FontAwesome Icons CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Base Layout CSS (Fixed Header, Left Sidebar, Base Grid) -->
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    
    <!-- CSS Terpisah Sesuai Halaman / Partial yang Aktif -->
    @yield('extra_css')
</head>
<body>

    <!-- 1. Header yang Tetap di Posisi Atas -->
    @include('partials.header')

    <!-- 2. Sidebar Sebelah Kiri -->
    @include('partials.sidebar')

    <!-- 3. Area Konten Utama -->
    <main class="main-wrapper">
        <div class="content-container">
            @yield('content')
        </div>

        <!-- 4. Footer, Copyright & Media Sosial -->
        @include('partials.footer')
    </main>

    <!-- Tombol WhatsApp Mengambang (Quick CTA) -->
    <a href="https://wa.me/6281234567890?text=Halo%20Mas%20Ibrahim,%20saya%20tertarik%20dengan%20jasa%20website%20/%20training%20pemrograman" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="floating-wa-btn" 
       title="Konsultasi Cepat via WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Notifikasi Flash Sukses / Error -->
    @if(session('sukses'))
        <div class="alert-popup-bar" id="flash-alert">
            <i class="fa-solid fa-circle-check" style="font-size: 1.3rem;"></i>
            <span>{{ session('sukses') }}</span>
        </div>
        <script>
            setTimeout(() => {
                const alertEl = document.getElementById('flash-alert');
                if (alertEl) {
                    alertEl.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    alertEl.style.opacity = '0';
                    alertEl.style.transform = 'translateY(-20px)';
                    setTimeout(() => alertEl.remove(), 500);
                }
            }, 4500);
        </script>
    @endif

    <!-- Script Navigasi Sidebar Mobile & Micro Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebar-toggle-btn');
            const sidebar = document.getElementById('left-sidebar');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('show-sidebar');
                });

                // Tutup sidebar jika klik di luar pada mobile
                document.addEventListener('click', function (e) {
                    if (window.innerWidth <= 992) {
                        if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('show-sidebar')) {
                            sidebar.classList.remove('show-sidebar');
                        }
                    }
                });
            }
        });
    </script>

    @yield('extra_js')
</body>
</html>
