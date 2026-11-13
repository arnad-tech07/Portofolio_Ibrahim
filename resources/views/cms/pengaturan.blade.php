@extends('layouts.cms')

@section('title', 'Ubah Profil, Kontak, Maps & Medsos - CMS Portofolio')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <h1 class="cms-page-title">Ubah Profil, Kontak, Maps, Medsos & Footer</h1>
            <p class="cms-page-desc">Sesuaikan seluruh identitas web, upload foto profil (JPG/JPEG/PNG/SVG), file CV, alamat Google Maps, media sosial, dan hak cipta.</p>
        </div>
    </div>

    <form action="{{ route('cms.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Seksi 1: Identitas Profil & Hero -->
        <div class="cms-panel-card">
            <h2 class="cms-panel-title" style="margin-bottom: 20px;">
                <i class="fa-solid fa-user-tie" style="color: #60a5fa;"></i> 1. Identitas Pribadi & Foto Profil
            </h2>

            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Nama Pemilik Web *</label>
                    <input type="text" name="name" class="cms-input" value="{{ old('name', $setting->name) }}" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Jabatan / Profesi / Tagline *</label>
                    <input type="text" name="title" class="cms-input" value="{{ old('title', $setting->title) }}" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Status Ketersediaan (Badge Hijau Header)</label>
                    <input type="text" name="status_text" class="cms-input" value="{{ old('status_text', $setting->status_text) }}">
                </div>

                <!-- Upload File Foto Profil JPG/JPEG/PNG/SVG -->
                <div class="cms-form-group">
                    <label class="cms-form-label">Upload Foto Profil Baru (JPG, JPEG, PNG, SVG - Ukuran Bebas s/d 20MB)</label>
                    <input type="file" name="avatar_file" class="cms-input" accept=".jpg,.jpeg,.png,.svg,.webp">
                    @if($setting->avatar_url)
                        <div style="margin-top: 8px; display: flex; align-items: center; gap: 10px;">
                            <img src="{{ $setting->avatar_url }}" alt="Preview Avatar" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid #3b82f6;">
                            <span style="font-size: 0.78rem; color: #9ca3af;">Foto saat ini aktif</span>
                        </div>
                    @endif
                </div>

                <!-- Upload File CV PDF -->
                <div class="cms-form-group">
                    <label class="cms-form-label">Upload File CV Dokumen (PDF, DOC, DOCX s/d 25MB)</label>
                    <input type="file" name="cv_file" class="cms-input" accept=".pdf,.doc,.docx,.zip">
                    @if($setting->cv_download_url)
                        <div style="margin-top: 8px;">
                            <a href="{{ $setting->cv_download_url }}" target="_blank" style="font-size: 0.78rem; color: #60a5fa;">
                                <i class="fa-solid fa-file-pdf"></i> Lihat file CV saat ini
                            </a>
                        </div>
                    @endif
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">Ringkasan Bio / Pengantar CV</label>
                    <textarea name="bio_summary" rows="3" class="cms-textarea">{{ old('bio_summary', $setting->bio_summary) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Seksi 2: Angka Statistik Kunci -->
        <div class="cms-panel-card">
            <h2 class="cms-panel-title" style="margin-bottom: 20px;">
                <i class="fa-solid fa-chart-line" style="color: #34d399;"></i> 2. Angka Statistik Utama (Counter)
            </h2>

            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Tahun Pengalaman Coding</label>
                    <input type="text" name="stat_years_exp" class="cms-input" value="{{ old('stat_years_exp', $setting->stat_years_exp) }}" placeholder="7+ Tahun">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Jumlah Proyek Selesai</label>
                    <input type="text" name="stat_projects_done" class="cms-input" value="{{ old('stat_projects_done', $setting->stat_projects_done) }}" placeholder="120+">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Jumlah Siswa Training</label>
                    <input type="text" name="stat_students_trained" class="cms-input" value="{{ old('stat_students_trained', $setting->stat_students_trained) }}" placeholder="500+">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Tingkat Kepuasan Klien</label>
                    <input type="text" name="stat_client_satisfaction" class="cms-input" value="{{ old('stat_client_satisfaction', $setting->stat_client_satisfaction) }}" placeholder="99.8%">
                </div>
            </div>
        </div>

        <!-- Seksi 3: Kontak & Google Maps -->
        <div class="cms-panel-card">
            <h2 class="cms-panel-title" style="margin-bottom: 20px;">
                <i class="fa-solid fa-map-location-dot" style="color: #fbbf24;"></i> 3. Kontak & Peta Lokasi (Maps)
            </h2>

            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Nomor WhatsApp (Hanya angka, contoh: 6281234567890) *</label>
                    <input type="text" name="whatsapp_number" class="cms-input" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Nomor Telepon Tampilan</label>
                    <input type="text" name="phone" class="cms-input" value="{{ old('phone', $setting->phone) }}" placeholder="+62 812-3456-7890">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Alamat Email Publik *</label>
                    <input type="email" name="email" class="cms-input" value="{{ old('email', $setting->email) }}" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Wilayah Operasional</label>
                    <input type="text" name="location" class="cms-input" value="{{ old('location', $setting->location) }}" placeholder="Jakarta & Bandung, Indonesia">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Jam Konsultasi Kerja</label>
                    <input type="text" name="working_hours" class="cms-input" value="{{ old('working_hours', $setting->working_hours) }}" placeholder="Senin - Sabtu (08:00 - 21:00 WIB)">
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">URL Embed Google Maps (Iframe Src)</label>
                    <input type="text" name="maps_embed_url" class="cms-input" value="{{ old('maps_embed_url', $setting->maps_embed_url) }}" placeholder="https://www.google.com/maps/embed?pb=...">
                </div>
            </div>
        </div>

        <!-- Seksi 4: Media Sosial & Footer Copyright -->
        <div class="cms-panel-card">
            <h2 class="cms-panel-title" style="margin-bottom: 20px;">
                <i class="fa-solid fa-share-nodes" style="color: #c084fc;"></i> 4. Media Sosial & Footer Copyright
            </h2>

            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label"><i class="fa-brands fa-github"></i> URL GitHub</label>
                    <input type="url" name="github_url" class="cms-input" value="{{ old('github_url', $setting->github_url) }}">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label"><i class="fa-brands fa-linkedin"></i> URL LinkedIn</label>
                    <input type="url" name="linkedin_url" class="cms-input" value="{{ old('linkedin_url', $setting->linkedin_url) }}">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label"><i class="fa-brands fa-instagram"></i> URL Instagram</label>
                    <input type="url" name="instagram_url" class="cms-input" value="{{ old('instagram_url', $setting->instagram_url) }}">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label"><i class="fa-brands fa-youtube"></i> URL YouTube</label>
                    <input type="url" name="youtube_url" class="cms-input" value="{{ old('youtube_url', $setting->youtube_url) }}">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label"><i class="fa-brands fa-x-twitter"></i> URL Twitter / X</label>
                    <input type="url" name="twitter_url" class="cms-input" value="{{ old('twitter_url', $setting->twitter_url) }}">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Teks Copyright Footer</label>
                    <input type="text" name="copyright_text" class="cms-input" value="{{ old('copyright_text', $setting->copyright_text) }}">
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">Deskripsi Singkat di Footer</label>
                    <textarea name="footer_about" rows="2" class="cms-textarea">{{ old('footer_about', $setting->footer_about) }}</textarea>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 40px;">
            <button type="submit" class="btn-cms-primary" style="padding: 14px 28px; font-size: 1rem;">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Perubahan Konten & Foto
            </button>
        </div>
    </form>
@endsection
