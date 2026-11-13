<!-- Bagian Apa Kata Mereka (Testimoni Klien & Alumni) -->
<section class="section-block" id="testimoni-section">
    <div class="section-header-center">
        <span class="section-pill-badge">
            <i class="fa-solid fa-comments"></i> Ulasan Klien & Siswa
        </span>
        <h2 class="section-title">Apa Kata Mereka?</h2>
        <p class="section-subtitle">
            Kesan, ulasan jujur, dan testimoni dari para pemilik bisnis yang menggunakan jasa pembuatan website maupun alumni program training pemrograman.
        </p>
    </div>

    <!-- Grid Testimoni -->
    <div class="testimonials-grid">
        @forelse($testimonials as $testi)
            <div class="testi-card">
                <i class="fa-solid fa-quote-right testi-quote-watermark"></i>

                <div>
                    <!-- Rating Bintang Emas -->
                    <div class="testi-rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testi->rating)
                                <i class="fa-solid fa-star"></i>
                            @else
                                <i class="fa-regular fa-star" style="color: #cbd5e1;"></i>
                            @endif
                        @endfor
                    </div>

                    <p class="testi-quote-text">
                        "{{ $testi->content }}"
                    </p>
                </div>

                <div class="testi-client-profile">
                    <img src="{{ $testi->avatar_url ?? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&auto=format&fit=crop&q=80' }}" 
                         alt="{{ $testi->name }}" 
                         class="testi-avatar-img">
                    <div>
                        <h4 class="testi-client-name">{{ $testi->name }}</h4>
                        <div class="testi-client-role">
                            {{ $testi->role }} {{ $testi->company ? '• ' . $testi->company : '' }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align: center; grid-column: 1 / -1; color: #64748b;">Belum ada testimoni.</p>
        @endforelse
    </div>
</section>

