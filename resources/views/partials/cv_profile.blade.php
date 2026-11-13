<!-- Bagian CV Digital & Profil Lengkap Ibrahim (Dikelola Penuh via CMS) -->
<section class="section-block" id="cv-section">
    <div class="section-header-center">
        <span class="section-pill-badge">
            <i class="fa-solid fa-id-card"></i> Curriculum Vitae Digital
        </span>
        <h2 class="section-title">Profil & Pengalaman Profesional</h2>
        <p class="section-subtitle">
            {{ $setting->bio_summary ?? 'Mengenal lebih dekat latar belakang, keahlian teknis, dan jejak karir Ibrahim sebagai software engineer dan instruktur teknologi web.' }}
        </p>
    </div>

    <!-- Header Profil CV -->
    <div class="cv-hero-card">
        <div class="cv-profile-grid">
            <div class="cv-large-avatar-box">
                <img src="{{ $setting->avatar_url ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300&auto=format&fit=crop&q=80' }}" 
                     alt="{{ $setting->name ?? 'Ibrahim' }}" 
                     class="cv-large-avatar">
                <span class="cv-verified-badge" title="Pengembang Terverifikasi">
                    <i class="fa-solid fa-check"></i>
                </span>
            </div>

            <div class="cv-profile-info">
                <h1>{{ $setting->name ?? 'Ibrahim' }}</h1>
                <div class="cv-profile-role">
                    <i class="fa-solid fa-terminal"></i> {{ $setting->title ?? 'Senior Fullstack Web Developer & Tech Lead' }}
                </div>
                <div class="cv-contact-chips">
                    <span class="cv-chip"><i class="fa-solid fa-location-dot"></i> {{ $setting->location ?? 'Indonesia' }}</span>
                    <span class="cv-chip"><i class="fa-solid fa-envelope"></i> {{ $setting->email ?? 'ibrahim@portfolio.com' }}</span>
                    <span class="cv-chip"><i class="fa-brands fa-whatsapp"></i> {{ $setting->phone ?? '+62 812-3456-7890' }}</span>
                    <span class="cv-chip"><i class="fa-solid fa-briefcase"></i> {{ $setting->status_text ?? 'Freelance & Konsultan IT' }}</span>
                </div>
            </div>

            <div class="cv-hero-actions">
                <a href="#kontak-section" class="btn-carousel-primary" style="padding: 11px 20px; font-size: 0.9rem;">
                    <i class="fa-solid fa-paper-plane"></i> Rekrut / Hubungi
                </a>
                <a href="{{ asset('downloads/CV_Portofolio_Ibrahim.doc') }}" download class="btn-cv-download" style="background: rgba(59, 130, 246, 0.15); border-color: #3b82f6; color: #93c5fd;" title="Unduh File CV Portofolio Lengkap Format .doc Word">
                    <i class="fa-solid fa-file-word"></i> Unduh CV (.doc)
                </a>
                <a href="{{ asset('downloads/EBOOK_PANDUAN_WEB_PORTOFOLIO_DAN_CMS_IBRAHIM.doc') }}" download class="btn-cv-download" style="background: rgba(16, 185, 129, 0.15); border-color: #10b981; color: #6ee7b7;" title="Unduh E-Book Panduan Komprehensif Web & CMS Format .doc">
                    <i class="fa-solid fa-book"></i> E-Book Panduan (.doc)
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik Kunci -->
    <div class="cv-stats-row">
        <div class="cv-stat-card">
            <div class="cv-stat-icon">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div>
                <div class="cv-stat-val">{{ $setting->stat_years_exp ?? '7+ Tahun' }}</div>
                <div class="cv-stat-label">Pengalaman Coding</div>
            </div>
        </div>
        <div class="cv-stat-card">
            <div class="cv-stat-icon">
                <i class="fa-solid fa-code-branch"></i>
            </div>
            <div>
                <div class="cv-stat-val">{{ $setting->stat_projects_done ?? '120+' }}</div>
                <div class="cv-stat-label">Proyek Web Selesai</div>
            </div>
        </div>
        <div class="cv-stat-card">
            <div class="cv-stat-icon">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div>
                <div class="cv-stat-val">{{ $setting->stat_students_trained ?? '500+' }}</div>
                <div class="cv-stat-label">Peserta Pelatihan</div>
            </div>
        </div>
        <div class="cv-stat-card">
            <div class="cv-stat-icon">
                <i class="fa-solid fa-award"></i>
            </div>
            <div>
                <div class="cv-stat-val">{{ $setting->stat_client_satisfaction ?? '99.8%' }}</div>
                <div class="cv-stat-label">Kepuasan Klien</div>
            </div>
        </div>
    </div>

    <!-- 2 Kolom: Pengalaman Kerja & Keahlian Teknis -->
    <div class="cv-body-grid">
        <!-- Kolom Kiri: Riwayat Pengalaman Kerja -->
        <div>
            <div class="cv-card-box">
                <div class="cv-box-header">
                    <i class="fa-solid fa-briefcase"></i>
                    <h3>Pengalaman Kerja & Karir</h3>
                </div>
                <div class="timeline-list">
                    @forelse($experiences as $exp)
                        <div class="timeline-item">
                            <span class="timeline-dot"></span>
                            <span class="timeline-year-tag">{{ $exp->period }}</span>
                            <h4 class="timeline-role">{{ $exp->role }}</h4>
                            <div class="timeline-company">{{ $exp->company }}</div>
                            <p class="timeline-desc">
                                {{ $exp->description }}
                            </p>
                        </div>
                    @empty
                        <p style="color: #64748b;">Belum ada data pengalaman kerja.</p>
                    @endforelse
                </div>
            </div>

            <!-- Pendidikan & Sertifikasi Formal -->
            <div class="cv-card-box">
                <div class="cv-box-header">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <h3>Riwayat Pendidikan</h3>
                </div>
                @forelse($educations as $edu)
                    <div class="cert-card">
                        <i class="{{ $edu->icon ?? 'fa-solid fa-university' }} cert-icon" style="color: #2563eb;"></i>
                        <div>
                            <div class="cert-title">{{ $edu->degree }}</div>
                            <div class="cert-issuer">{{ $edu->institution }} @if($edu->year_graduated) • {{ $edu->year_graduated }} @endif</div>
                        </div>
                    </div>
                @empty
                    <p style="color: #64748b;">Belum ada riwayat pendidikan.</p>
                @endforelse
            </div>
        </div>

        <!-- Kolom Kanan: Keahlian Teknis & Sertifikasi -->
        <div>
            <div class="cv-card-box">
                <div class="cv-box-header">
                    <i class="fa-solid fa-gears"></i>
                    <h3>Keahlian Teknis & Tools</h3>
                </div>

                @forelse($skills as $skill)
                    <div class="skill-group">
                        <div class="skill-header">
                            <span>
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }}" style="margin-right: 4px;"></i>
                                @endif
                                {{ $skill->name }}
                            </span>
                            <span>{{ $skill->percentage }}%</span>
                        </div>
                        <div class="skill-progress-bar">
                            <div class="skill-progress-fill" style="width: {{ $skill->percentage }}%;"></div>
                        </div>
                    </div>
                @empty
                    <p style="color: #64748b;">Belum ada data skill.</p>
                @endforelse
            </div>

            <!-- Sertifikasi Resmi -->
            <div class="cv-card-box">
                <div class="cv-box-header">
                    <i class="fa-solid fa-certificate"></i>
                    <h3>Sertifikasi Profesional</h3>
                </div>

                @forelse($certifications as $cert)
                    <div class="cert-card">
                        <i class="{{ $cert->icon ?? 'fa-solid fa-award' }} cert-icon" style="color: {{ $cert->icon_color ?? '#f59e0b' }};"></i>
                        <div>
                            <div class="cert-title">{{ $cert->title }}</div>
                            <div class="cert-issuer">{{ $cert->issuer }} @if($cert->year) • {{ $cert->year }} @endif</div>
                        </div>
                    </div>
                @empty
                    <p style="color: #64748b;">Belum ada sertifikasi.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
