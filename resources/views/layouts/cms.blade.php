<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CMS Portofolio - Panel Kontrol Pemilik')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('css/cms.css') }}">
    @yield('extra_css')
</head>
<body class="cms-body">

    <!-- CMS Topbar -->
    <header class="cms-topbar">
        <div class="cms-brand">
            <span style="width: 32px; height: 32px; background: linear-gradient(135deg, #3b82f6, #06b6d4); border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: 1rem; color: #fff;">
                <i class="fa-solid fa-sliders"></i>
            </span>
            <span>CMS IBRAHIM</span>
            <span style="font-size: 0.72rem; padding: 2px 8px; background: rgba(59, 130, 246, 0.2); color: #60a5fa; border-radius: 12px; font-weight: 700;">CONTROL PANEL</span>
        </div>

        <div class="cms-topbar-actions">
            <a href="{{ route('home') }}" target="_blank" class="btn-cms-view-site">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Web Publik
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-cms-logout">
                    <i class="fa-solid fa-power-off"></i> Keluar
                </button>
            </form>
        </div>
    </header>

    <!-- CMS Sidebar -->
    <aside class="cms-sidebar">
        <div class="cms-sidebar-user">
            @php
                $siteSetting = \App\Models\ProfileSetting::first();
            @endphp
            <img src="{{ $siteSetting->avatar_url ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80' }}" alt="Avatar" class="cms-user-avatar">
            <div>
                <div class="cms-user-name">{{ Auth::user()->name ?? 'Ibrahim' }}</div>
                <div class="cms-user-role"><i class="fa-solid fa-shield-cat"></i> Pemilik / Administrator</div>
            </div>
        </div>

        <div class="cms-nav-group-title">Navigasi Utama</div>
        <ul class="cms-nav-menu">
            <li>
                <a href="{{ route('cms.dashboard') }}" class="{{ request()->routeIs('cms.dashboard') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-chart-pie"></i> Dashboard Utama</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.akun') }}" class="{{ request()->routeIs('cms.akun') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-user-shield"></i> Akun & Keamanan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.pesan') }}" class="{{ request()->routeIs('cms.pesan') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-envelope"></i> Pesan Masuk</span>
                    @php
                        $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="cms-badge-unread">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>
        </ul>

        <div class="cms-nav-group-title">Ubah Semua Konten Web</div>
        <ul class="cms-nav-menu">
            <li>
                <a href="{{ route('cms.pengaturan') }}" class="{{ request()->routeIs('cms.pengaturan') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-gear"></i> Profil, Maps & Medsos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.banner') }}" class="{{ request()->routeIs('cms.banner') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-images"></i> Slide Banner Carousel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.cv') }}" class="{{ request()->routeIs('cms.cv') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-id-card"></i> Isi CV (Karir & Skill)</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.layanan') }}" class="{{ request()->routeIs('cms.layanan') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-briefcase"></i> Layanan Web & Training</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.proyek') }}" class="{{ request()->routeIs('cms.proyek') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-folder-open"></i> Card Dokumentasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.video') }}" class="{{ request()->routeIs('cms.video') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-circle-play"></i> Card Video Showcase</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.testimoni') }}" class="{{ request()->routeIs('cms.testimoni') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-comments"></i> Apa Kata Mereka</span>
                </a>
            </li>
        </ul>

        <div class="cms-nav-group-title">Situs Publik</div>
        <ul class="cms-nav-menu">
            <li>
                <a href="{{ route('home') }}">
                    <span class="link-content"><i class="fa-solid fa-house"></i> Kembali ke Beranda</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- CMS Main Content -->
    <main class="cms-main-content">
        @if(session('sukses'))
            <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; padding: 14px 18px; border-radius: 8px; margin-bottom: 24px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('sukses') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; padding: 14px 18px; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @yield('cms_content')
    </main>

    @yield('extra_js')
</body>
</html>
