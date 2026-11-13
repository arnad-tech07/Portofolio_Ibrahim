<!-- Slide Banner Carousel Interaktif (Dikelola Penuh via CMS) -->
<section class="carousel-section" id="carousel-banner-wrapper">
    <div class="carousel-container" id="mainCarousel">
        
        @forelse($bannerSlides as $index => $slide)
            <div class="carousel-slide {{ $slide->bg_gradient ?? 'slide-bg-1' }} {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                <div class="slide-content-grid">
                    <div class="slide-text-col">
                        <span class="slide-badge-pill">
                            <i class="fa-solid fa-code"></i> {{ $slide->badge_text }}
                        </span>
                        <h1 class="slide-title">
                            {{ $slide->title }}
                            @if($slide->highlight_text)
                                <span class="highlight-gradient">{{ $slide->highlight_text }}</span>
                            @endif
                        </h1>
                        <p class="slide-desc">
                            {{ $slide->description }}
                        </p>
                        <div class="slide-cta-group">
                            @if($slide->button1_text)
                                <a href="{{ $slide->button1_url ?? '#kontak-section' }}" class="btn-carousel-primary">
                                    <i class="fa-solid fa-arrow-right"></i> {{ $slide->button1_text }}
                                </a>
                            @endif
                            @if($slide->button2_text)
                                <a href="{{ $slide->button2_url ?? '#layanan-section' }}" class="btn-carousel-secondary">
                                    <i class="fa-solid fa-info-circle"></i> {{ $slide->button2_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="slide-graphic-col">
                        <div class="graphic-card-mockup">
                            <div class="mockup-header-dots">
                                <span class="mockup-dot red"></span>
                                <span class="mockup-dot yellow"></span>
                                <span class="mockup-dot green"></span>
                            </div>
                            <i class="{{ $slide->mockup_icon ?? 'fa-solid fa-laptop-code' }} mockup-icon-glow"></i>
                            <h4 style="color: #ffffff; font-size: 1.1rem; font-weight: 700; margin-bottom: 6px;">{{ $slide->mockup_title ?? 'Solusi Digital' }}</h4>
                            <p style="color: #94a3b8; font-size: 0.82rem;">{{ $slide->mockup_desc ?? 'Modern, Cepat, dan Aman.' }}</p>
                            @if($slide->mockup_stat1_val || $slide->mockup_stat2_val)
                                <div class="mockup-stats-grid">
                                    @if($slide->mockup_stat1_val)
                                        <div class="mockup-stat-item">
                                            <div class="mockup-stat-num">{{ $slide->mockup_stat1_val }}</div>
                                            <div class="mockup-stat-label">{{ $slide->mockup_stat1_label }}</div>
                                        </div>
                                    @endif
                                    @if($slide->mockup_stat2_val)
                                        <div class="mockup-stat-item">
                                            <div class="mockup-stat-num">{{ $slide->mockup_stat2_val }}</div>
                                            <div class="mockup-stat-label">{{ $slide->mockup_stat2_label }}</div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="carousel-slide slide-bg-1 active" data-index="0">
                <div class="slide-content-grid">
                    <div class="slide-text-col">
                        <h1 class="slide-title">Portofolio Digital Ibrahim</h1>
                        <p class="slide-desc">Belum ada slide banner yang aktif. Silakan tambahkan melalui CMS.</p>
                    </div>
                </div>
            </div>
        @endforelse

        <!-- Tombol Kontrol Prev / Next -->
        <button class="carousel-btn prev-btn" id="carousel-prev-btn" aria-label="Slide Sebelumnya">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="carousel-btn next-btn" id="carousel-next-btn" aria-label="Slide Selanjutnya">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <!-- Indikator Slide (Dots) -->
        <div class="carousel-indicators" id="carousel-dots-container">
            @foreach($bannerSlides as $index => $slide)
                <span class="indicator-dot {{ $index === 0 ? 'active' : '' }}" data-target="{{ $index }}"></span>
            @endforeach
        </div>
    </div>
</section>

<!-- Script Interaktif Carousel -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.indicator-dot');
        const prevBtn = document.getElementById('carousel-prev-btn');
        const nextBtn = document.getElementById('carousel-next-btn');
        const wrapper = document.getElementById('carousel-banner-wrapper');
        let currentSlide = 0;
        let slideTimer = null;

        if (slides.length <= 1) {
            if (prevBtn) prevBtn.style.display = 'none';
            if (nextBtn) nextBtn.style.display = 'none';
            return;
        }

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            currentSlide = (index + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            if (dots[currentSlide]) dots[currentSlide].classList.add('active');
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function startAutoSlide() {
            if (!slideTimer && slides.length > 1) {
                slideTimer = setInterval(nextSlide, 5500);
            }
        }

        function stopAutoSlide() {
            if (slideTimer) {
                clearInterval(slideTimer);
                slideTimer = null;
            }
        }

        if (nextBtn && prevBtn) {
            nextBtn.addEventListener('click', () => { nextSlide(); stopAutoSlide(); startAutoSlide(); });
            prevBtn.addEventListener('click', () => { prevSlide(); stopAutoSlide(); startAutoSlide(); });
        }

        dots.forEach(dot => {
            dot.addEventListener('click', function () {
                const targetIdx = parseInt(this.getAttribute('data-target'));
                showSlide(targetIdx);
                stopAutoSlide();
                startAutoSlide();
            });
        });

        if (wrapper) {
            wrapper.addEventListener('mouseenter', stopAutoSlide);
            wrapper.addEventListener('mouseleave', startAutoSlide);
        }

        startAutoSlide();
    });
</script>
