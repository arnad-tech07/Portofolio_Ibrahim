<aside class="sidebar" id="sidebar">
    <a href="{{ route('home') }}" class="sidebar-brand">
        <span class="brand-mark">I</span>
        <span><strong>Ibrahim</strong><small>Digital Developer</small></span>
    </a>
    <nav class="sidebar-nav" aria-label="Navigasi utama">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="fa-solid fa-house"></i><span>Beranda</span></a>
        <a href="{{ route('cv') }}" class="{{ request()->routeIs('cv') ? 'active' : '' }}"><i class="fa-solid fa-id-card"></i><span>Profil & CV</span></a>
        <a href="{{ route('layanan') }}" class="{{ request()->routeIs('layanan') ? 'active' : '' }}"><i class="fa-solid fa-briefcase"></i><span>Layanan</span></a>
        <a href="{{ route('dokumentasi') }}" class="{{ request()->routeIs('dokumentasi') ? 'active' : '' }}"><i class="fa-solid fa-images"></i><span>Dokumentasi</span></a>
        <a href="{{ route('video') }}" class="{{ request()->routeIs('video') ? 'active' : '' }}"><i class="fa-solid fa-circle-play"></i><span>Video</span></a>
        <a href="{{ route('testimoni') }}" class="{{ request()->routeIs('testimoni') ? 'active' : '' }}"><i class="fa-solid fa-comment-dots"></i><span>Testimoni</span></a>
        <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}"><i class="fa-solid fa-envelope"></i><span>Kontak</span></a>
    </nav>
    <div class="sidebar-footer">
        <a href="{{ route('login') }}"><i class="fa-solid fa-lock"></i> Kelola Website</a>
        <small>&copy; {{ date('Y') }} Ibrahim Portfolio</small>
    </div>
</aside>
