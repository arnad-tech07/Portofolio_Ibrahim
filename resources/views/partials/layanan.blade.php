<!-- Bagian Layanan Jasa Pembuatan Website & Training -->
<section class="section-block" id="layanan-section">
    <div class="section-header-center">
        <span class="section-pill-badge">
            <i class="fa-solid fa-briefcase"></i> Penawaran Jasa & Edukasi
        </span>
        <h2 class="section-title">Layanan Profesional & Pelatihan</h2>
        <p class="section-subtitle">
            Solusi digital komprehensif mulai dari perancangan website bisnis hingga bimbingan intensif bagi Anda yang ingin menjadi programmer web handal.
        </p>
    </div>

    <!-- Filter Kategori Layanan -->
    <div class="services-filter-tabs">
        <button type="button" class="service-tab-btn active" data-filter="all">
            <i class="fa-solid fa-layer-group"></i> Semua Layanan
        </button>
        <button type="button" class="service-tab-btn" data-filter="website">
            <i class="fa-solid fa-laptop-code"></i> Jasa Pembuatan Website
        </button>
        <button type="button" class="service-tab-btn" data-filter="training">
            <i class="fa-solid fa-graduation-cap"></i> Training Pemrograman
        </button>
    </div>

    <!-- Grid Kartu Layanan -->
    <div class="services-cards-grid" id="servicesGrid">
        @forelse($services as $srv)
            <div class="service-item-card {{ $srv->category == 'training' ? 'is-training' : '' }}" data-category="{{ $srv->category }}">
                <div>
                    <div class="service-card-top">
                        <div class="service-icon-box">
                            <i class="{{ $srv->icon ?? 'fa-solid fa-code' }}"></i>
                        </div>
                        @if($srv->badge)
                            <span class="service-badge {{ in_array(strtolower($srv->badge), ['populer', 'best seller', 'vip']) ? 'gold' : '' }}">
                                {{ $srv->badge }}
                            </span>
                        @endif
                    </div>

                    <h3 class="service-card-title">{{ $srv->title }}</h3>
                    <p class="service-card-desc">{{ $srv->short_desc ?? $srv->description }}</p>

                    @if(!empty($srv->features) && is_array($srv->features))
                        <ul class="service-features-list">
                            @foreach($srv->features as $feature)
                                <li class="service-feature-item">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="service-card-footer">
                    <div class="service-price-block">
                        <span class="price-subtext">Investasi / Tarif</span>
                        <span class="service-price-val">{{ $srv->price ?? 'Hubungi Kami' }}</span>
                    </div>
                    <a href="https://wa.me/6281234567890?text=Halo%20Mas%20Ibrahim,%20saya%20berminat%20dengan%20layanan:%20{{ urlencode($srv->title) }}" 
                       target="_blank" 
                       class="btn-service-action">
                        <i class="fa-brands fa-whatsapp"></i> Pesan / Konsultasi
                    </a>
                </div>
            </div>
        @empty
            <p style="text-align: center; grid-column: 1 / -1; color: #64748b;">Belum ada data layanan.</p>
        @endforelse
    </div>
</section>

<!-- Filter Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterBtns = document.querySelectorAll('.service-tab-btn');
        const serviceCards = document.querySelectorAll('.service-item-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filterVal = this.getAttribute('data-filter');
                serviceCards.forEach(card => {
                    if (filterVal === 'all' || card.getAttribute('data-category') === filterVal) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

