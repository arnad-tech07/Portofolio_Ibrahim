<!-- Sidebar Sebelah Kiri (Left Sidebar Navigation) -->
<aside class="left-sidebar" id="left-sidebar">
    <div>
        <!-- Profil Singkat Ibrahim -->
        <div class="sidebar-profile">
            <div class="profile-avatar-wrapper">
                <img src="{{ $setting->avatar_url ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300&auto=format&fit=crop&q=80' }}" 
                     alt="Foto {{ $setting->name ?? 'Ibrahim' }}" 
                     class="profile-avatar-img">
                <span class="profile-avatar-badge" title="Status Online"></span>
            </div>
            <h2 class="profile-name">{{ $setting->name ?? 'Ibrahim' }}</h2>
            <p class="profile-title">{{ $setting->title ?? 'Fullstack Web Dev & IT Trainer' }}</p>
        </div>

        <!-- Navigasi Menu Halaman & Section -->
        <nav class="sidebar-nav">
            <div class="nav-category-label">Menu Utama</div>
            <ul class="sidebar-menu">
                <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="fa-solid fa-house menu-icon"></i>
                        <span>Beranda Utama</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('cv') ? 'active' : '' }}">
                    <a href="{{ route('home') }}#cv-section">
                        <i class="fa-solid fa-id-card menu-icon"></i>
                        <span>Profil & CV Digital</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('layanan') ? 'active' : '' }}">
                    <a href="{{ route('home') }}#layanan-section">
                        <i class="fa-solid fa-briefcase menu-icon"></i>
                        <span>Jasa Website & Training</span>
                    </a>
                </li>
            </ul>

            <div class="nav-category-label">Portofolio & Media</div>
            <ul class="sidebar-menu">
                <li class="menu-item {{ request()->routeIs('dokumentasi') ? 'active' : '' }}">
                    <a href="{{ route('home') }}#dokumentasi-section">
                        <i class="fa-solid fa-folder-open menu-icon"></i>
                        <span>Card Dokumentasi</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('video') ? 'active' : '' }}">
                    <a href="{{ route('home') }}#video-section">
                        <i class="fa-solid fa-play-circle menu-icon"></i>
                        <span>Card Video Showcase</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('testimoni') ? 'active' : '' }}">
                    <a href="{{ route('home') }}#testimoni-section">
                        <i class="fa-solid fa-comments menu-icon"></i>
                        <span>Apa Kata Mereka</span>
                    </a>
                </li>
            </ul>

            <div class="nav-category-label">Koneksi & Sistem</div>
            <ul class="sidebar-menu">
                <li class="menu-item {{ request()->routeIs('kontak') ? 'active' : '' }}">
                    <a href="{{ route('home') }}#kontak-section">
                        <i class="fa-solid fa-map-location-dot menu-icon"></i>
                        <span>Maps & Kontak</span>
                    </a>
                </li>
                @auth
                    <li class="menu-item">
                        <a href="{{ route('cms.dashboard') }}">
                            <i class="fa-solid fa-sliders menu-icon"></i>
                            <span>Kelola CMS (Owner)</span>
                        </a>
                    </li>
                @else
                    <li class="menu-item {{ request()->routeIs('login') ? 'active' : '' }}">
                        <a href="{{ route('login') }}">
                            <i class="fa-solid fa-lock menu-icon"></i>
                            <span>Login Pemilik (CMS)</span>
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>

    <!-- Sidebar CTA Widget -->
    <div class="sidebar-footer">
        <div class="sidebar-cta-box">
            <p><i class="fa-solid fa-lightbulb" style="color: #fbbf24;"></i> Butuh Website Cepat & Berkualitas?</p>
            <a href="https://wa.me/{{ $setting->whatsapp_number ?? '6281234567890' }}?text=Halo%20{{ urlencode($setting->name ?? 'Ibrahim') }},%20saya%20butuh%20pembuatan%20website" target="_blank" class="sidebar-cta-btn">
                Mulai Diskusi Proyek
            </a>
        </div>
    </div>
</aside>
