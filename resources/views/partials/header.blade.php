<!-- Header yang Tetap di Posisi Atas (Fixed Top Header) -->
<header class="fixed-header">
    <div class="header-brand">
        <!-- Tombol Menu Mobile -->
        <button type="button" class="brand-toggle-btn" id="sidebar-toggle-btn" aria-label="Buka Menu Sidebar">
            <i class="fa-solid fa-bars"></i>
        </button>

        <a href="{{ route('home') }}" class="brand-logo">
            <div class="brand-badge-icon">
                <i class="fa-solid fa-code"></i>
            </div>
            <span>{{ strtoupper($setting->name ?? 'IBRAHIM') }}</span>
        </a>

        <div class="brand-status-tag">
            <span class="status-dot"></span>
            <span>{{ $setting->status_text ?? 'Tersedia untuk Jasa & Training' }}</span>
        </div>
    </div>

    <div class="header-actions">
        <a href="https://wa.me/{{ $setting->whatsapp_number ?? '6281234567890' }}?text=Halo%20{{ urlencode($setting->name ?? 'Ibrahim') }},%20saya%20ingin%20konsultasi%20pembuatan%20website%20/%20training" 
           target="_blank" 
           class="btn-header-contact">
            <i class="fa-brands fa-whatsapp"></i>
            <span>Konsultasi Cepat</span>
        </a>

        @auth
            <a href="{{ route('cms.dashboard') }}" class="btn-header-cms">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Panel CMS</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-header-contact" style="border-color: rgba(239, 68, 68, 0.4); color: #f87171; background: rgba(239,68,68,0.1); cursor: pointer;">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar</span>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-header-cms">
                <i class="fa-solid fa-lock"></i>
                <span>Login Pemilik</span>
            </a>
        @endauth
    </div>
</header>
