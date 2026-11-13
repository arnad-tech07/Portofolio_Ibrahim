<header class="topbar">
    <button class="menu-toggle" type="button" aria-label="Buka menu" onclick="document.getElementById('sidebar').classList.toggle('show')">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div>
        <span class="topbar-kicker">Portofolio digital</span>
        <strong>{{ $pageTitle ?? 'Ibrahim' }}</strong>
    </div>
    <div class="topbar-actions">
        <a class="status-online" href="{{ route('kontak') }}"><span></span>Tersedia untuk proyek</a>
        <a class="icon-action" href="mailto:ibrahim@portfolio.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
    </div>
</header>
