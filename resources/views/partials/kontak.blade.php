<!-- Bagian Kontak & Lokasi Peta (Maps) (Dikelola via CMS) -->
<section class="section-block" id="kontak-section">
    <div class="section-header-center">
        <span class="section-pill-badge">
            <i class="fa-solid fa-map-location-dot"></i> Hubungi & Lokasi
        </span>
        <h2 class="section-title">Mari Berdiskusi & Berkolaborasi</h2>
        <p class="section-subtitle">
            Punya rencana pembuatan website baru, ingin modernisasi sistem lama, atau butuh pelatihan pemrograman privat? Kirim pesan langsung di bawah ini.
        </p>
    </div>

    <div class="contact-maps-grid">
        <!-- Kolom Kiri: Info Kontak & Google Maps -->
        <div class="contact-info-col">
            <div class="contact-meta-cards">
                <div class="contact-meta-item">
                    <div class="contact-meta-icon">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <div class="contact-meta-label">WhatsApp / Telp</div>
                        <div class="contact-meta-val">{{ $setting->phone ?? '+62 812-3456-7890' }}</div>
                    </div>
                </div>

                <div class="contact-meta-item">
                    <div class="contact-meta-icon">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <div>
                        <div class="contact-meta-label">Alamat Email</div>
                        <div class="contact-meta-val">{{ $setting->email ?? 'ibrahim@portfolio.com' }}</div>
                    </div>
                </div>

                <div class="contact-meta-item">
                    <div class="contact-meta-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <div class="contact-meta-label">Wilayah Operasional</div>
                        <div class="contact-meta-val">{{ $setting->location ?? 'Jabodetabek & Seluruh Indonesia' }}</div>
                    </div>
                </div>

                <div class="contact-meta-item">
                    <div class="contact-meta-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <div class="contact-meta-label">Jam Konsultasi</div>
                        <div class="contact-meta-val">{{ $setting->working_hours ?? 'Senin - Sabtu (08:00 - 21:00 WIB)' }}</div>
                    </div>
                </div>
            </div>

            <!-- Include Peta Google Maps Interaktif -->
            @include('partials.maps')
        </div>

        <!-- Kolom Kanan: Formulir Kirim Pesan -->
        <div class="contact-form-card">
            <h3 class="contact-form-title">Kirimkan Permintaan Anda</h3>
            <p class="contact-form-subtitle">Formulir ini langsung terhubung dengan notifikasi CMS {{ $setting->name ?? 'Ibrahim' }}.</p>

            @if(session('sukses'))
                <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; color: #065f46; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-weight: 600; font-size: 0.9rem;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('sukses') }}
                </div>
            @endif

            <form action="{{ route('kirim.pesan') }}" method="POST">
                @csrf
                <div class="form-group-row">
                    <div class="form-field-group">
                        <label for="contact-name">Nama Lengkap *</label>
                        <input type="text" id="contact-name" name="nama" class="form-control-input" placeholder="Contoh: Budi Santoso" value="{{ old('nama') }}" required>
                    </div>

                    <div class="form-field-group">
                        <label for="contact-email">Alamat Email *</label>
                        <input type="email" id="contact-email" name="email" class="form-control-input" placeholder="nama@email.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-field-group">
                        <label for="contact-phone">No. WhatsApp / Telepon</label>
                        <input type="tel" id="contact-phone" name="telepon" class="form-control-input" placeholder="0812xxxxxxx" value="{{ old('telepon') }}">
                    </div>

                    <div class="form-field-group">
                        <label for="contact-service">Layanan yang Diminati</label>
                        <select id="contact-service" name="layanan" class="form-control-input">
                            <option value="Jasa Pembuatan Website">Jasa Pembuatan Website</option>
                            <option value="Training Pemrograman Web">Training Pemrograman Web</option>
                            <option value="Mentoring Privat 1-on-1">Mentoring Privat 1-on-1</option>
                            <option value="Konsultasi & Audit Sistem IT">Konsultasi & Audit Sistem IT</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="form-field-group">
                    <label for="contact-message">Detail Kebutuhan / Pesan *</label>
                    <textarea id="contact-message" name="pesan" rows="4" class="form-control-input" placeholder="Tuliskan spesifikasi website, target tanggal selesai, atau pertanyaan materi pelatihan..." required>{{ old('pesan') }}</textarea>
                </div>

                <button type="submit" class="btn-contact-submit">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Pesan Sekarang
                </button>
            </form>
        </div>
    </div>
</section>
