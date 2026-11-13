<!-- Footer, Copyright & Media Sosial (Dikelola via CMS) -->
<footer class="site-footer">
    <div class="content-container" style="padding-top: 0; padding-bottom: 0;">
        <div class="footer-top-grid">
            <!-- Kolom 1: Profil Brand & Bio Singkat -->
            <div>
                <div class="footer-brand-title">
                    <div class="brand-badge-icon" style="width: 32px; height: 32px; font-size: 0.95rem;">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <span>{{ strtoupper($setting->name ?? 'IBRAHIM') }}</span>
                </div>
                <p class="footer-brand-desc">
                    {{ $setting->footer_about ?? 'Pengembang web profesional dan instruktur teknologi yang berfokus menciptakan solusi aplikasi modern, aman, responsif, dan mudah dikelola.' }}
                </p>
                
                <!-- Media Sosial -->
                <div class="footer-social-row">
                    @if(!empty($setting->github_url))
                        <a href="{{ $setting->github_url }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn github" title="GitHub Profile">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    @endif
                    @if(!empty($setting->linkedin_url))
                        <a href="{{ $setting->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn linkedin" title="LinkedIn Profile">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    @endif
                    @if(!empty($setting->instagram_url))
                        <a href="{{ $setting->instagram_url }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn instagram" title="Instagram Profile">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif
                    @if(!empty($setting->youtube_url))
                        <a href="{{ $setting->youtube_url }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn youtube" title="YouTube Channel">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    @endif
                    @if(!empty($setting->whatsapp_number))
                        <a href="https://wa.me/{{ $setting->whatsapp_number }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn whatsapp" title="Chat WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    @endif
                    @if(!empty($setting->twitter_url))
                        <a href="{{ $setting->twitter_url }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn twitter" title="Twitter / X">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Kolom 2: Navigasi Cepat -->
            <div>
                <h4 class="footer-col-title">Navigasi Halaman</h4>
                <ul class="footer-links-list">
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right"></i> Beranda</a></li>
                    <li><a href="{{ route('home') }}#cv-section"><i class="fa-solid fa-angle-right"></i> Curriculum Vitae</a></li>
                    <li><a href="{{ route('home') }}#layanan-section"><i class="fa-solid fa-angle-right"></i> Jasa & Training</a></li>
                    <li><a href="{{ route('home') }}#dokumentasi-section"><i class="fa-solid fa-angle-right"></i> Dokumentasi Proyek</a></li>
                    <li><a href="{{ route('home') }}#video-section"><i class="fa-solid fa-angle-right"></i> Galeri Video</a></li>
                    <li><a href="{{ route('home') }}#testimoni-section"><i class="fa-solid fa-angle-right"></i> Apa Kata Mereka</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Layanan Spesifik -->
            <div>
                <h4 class="footer-col-title">Layanan Unggulan</h4>
                <ul class="footer-links-list">
                    <li><a href="{{ route('home') }}#layanan-section"><i class="fa-solid fa-angle-right"></i> Company Profile</a></li>
                    <li><a href="{{ route('home') }}#layanan-section"><i class="fa-solid fa-angle-right"></i> E-Commerce Pro</a></li>
                    <li><a href="{{ route('home') }}#layanan-section"><i class="fa-solid fa-angle-right"></i> Aplikasi Web Custom</a></li>
                    <li><a href="{{ route('home') }}#layanan-section"><i class="fa-solid fa-angle-right"></i> Training Laravel 12</a></li>
                    <li><a href="{{ route('home') }}#layanan-section"><i class="fa-solid fa-angle-right"></i> Mentoring 1-on-1</a></li>
                    <li><a href="{{ route('home') }}#layanan-section"><i class="fa-solid fa-angle-right"></i> Corporate IT Training</a></li>
                </ul>
            </div>

            <!-- Kolom 4: Hubungi & Login CMS -->
            <div>
                <h4 class="footer-col-title">Sistem & Kontak</h4>
                <ul class="footer-links-list">
                    <li><a href="mailto:{{ $setting->email ?? 'ibrahim@portfolio.com' }}"><i class="fa-regular fa-envelope"></i> {{ $setting->email ?? 'ibrahim@portfolio.com' }}</a></li>
                    <li><a href="https://wa.me/{{ $setting->whatsapp_number ?? '6281234567890' }}"><i class="fa-brands fa-whatsapp"></i> {{ $setting->phone ?? '+62 812-3456-7890' }}</a></li>
                    <li><a href="{{ route('home') }}#kontak-section"><i class="fa-solid fa-location-dot"></i> {{ $setting->location ?? 'Jakarta - Bandung' }}</a></li>
                    <li style="margin-top: 6px;">
                        <a href="{{ asset('downloads/CV_Portofolio_Ibrahim.doc') }}" download style="color: #93c5fd;">
                            <i class="fa-solid fa-file-word"></i> Unduh CV Resmi (.doc)
                        </a>
                    </li>
                    <li>
                        <a href="{{ asset('downloads/EBOOK_PANDUAN_WEB_PORTOFOLIO_DAN_CMS_IBRAHIM.doc') }}" download style="color: #6ee7b7;">
                            <i class="fa-solid fa-book"></i> E-Book Panduan (.doc)
                        </a>
                    </li>
                    @auth
                        <li style="margin-top: 8px;">
                            <a href="{{ route('cms.dashboard') }}" style="color: #60a5fa; font-weight: 700;">
                                <i class="fa-solid fa-sliders"></i> Panel Dashboard CMS
                            </a>
                        </li>
                    @else
                        <li style="margin-top: 8px;">
                            <a href="{{ route('login') }}" style="color: #60a5fa; font-weight: 700;">
                                <i class="fa-solid fa-lock"></i> Login Pemilik (CMS)
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>

        <!-- Baris Bawah: Copyright -->
        <div class="footer-bottom-bar">
            <div class="footer-copyright-text">
                &copy; {{ date('Y') }} <strong>{{ $setting->copyright_text ?? 'Ibrahim Digital Portfolio. Hak Cipta Dilindungi Undang-Undang.' }}</strong>
            </div>
            <div class="footer-credit-text">
                <span>Ditenagai oleh Laravel 12 & Modern CSS</span>
                <i class="fa-solid fa-heart"></i>
            </div>
        </div>
    </div>
</footer>
