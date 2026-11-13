@extends('layouts.cms')

@section('title', 'Konten Profil & Website')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <span class="cms-page-eyebrow">Pengaturan situs</span>
            <h1>Konten Profil & Website</h1>
            <p>Ubah identitas, foto profil, informasi kontak, statistik, media sosial, dan teks footer yang tampil di website.</p>
        </div>
    </div>

    <form action="{{ route('cms.konten.update') }}" method="POST" enctype="multipart/form-data" class="cms-form-layout">
        @csrf
        @method('PUT')

        <section class="cms-admin-card cms-form-wide">
            <div class="cms-admin-card-header"><div><span class="cms-card-icon"><i class="fa-solid fa-user"></i></span><div><h3>Identitas & Hero</h3><p>Konten utama pada profil dan header website.</p></div></div></div>
            <div class="cms-form-grid">
                <label>Nama lengkap<input name="name" value="{{ old('name', $profile->name ?: 'Ibrahim') }}" required></label>
                <label>Jabatan / profesi<input name="title" value="{{ old('title', $profile->title) }}" required></label>
                <label>Status ketersediaan<input name="status_text" value="{{ old('status_text', $profile->status_text) }}" required></label>
                <label>Upload foto profil baru<input type="file" name="avatar" accept="image/jpeg,image/png,image/webp"></label>
                <label>URL file CV / resume<input name="cv_download_url" value="{{ old('cv_download_url', $profile->cv_download_url) }}" placeholder="https://..."></label>
                <label class="cms-form-full">Ringkasan profil<textarea name="bio_summary" rows="5">{{ old('bio_summary', $profile->bio_summary) }}</textarea></label>
            </div>
        </section>

        <section class="cms-admin-card cms-form-wide">
            <div class="cms-admin-card-header"><div><span class="cms-card-icon"><i class="fa-solid fa-address-book"></i></span><div><h3>Kontak & Lokasi</h3><p>Informasi yang digunakan pada header, kontak, WhatsApp, dan footer.</p></div></div></div>
            <div class="cms-form-grid">
                <label>Email<input type="email" name="email" value="{{ old('email', $profile->email ?: 'ibrahim@portfolio.com') }}" required></label>
                <label>Nomor telepon<input name="phone" value="{{ old('phone', $profile->phone) }}" required></label>
                <label>Nomor WhatsApp tanpa +<input name="whatsapp_number" value="{{ old('whatsapp_number', $profile->whatsapp_number) }}" required></label>
                <label>Lokasi<input name="location" value="{{ old('location', $profile->location) }}" required></label>
                <label>Jam kerja<input name="working_hours" value="{{ old('working_hours', $profile->working_hours) }}"></label>
                <label class="cms-form-full">URL embed Google Maps<textarea name="maps_embed_url" rows="3" placeholder="https://www.google.com/maps/embed?...">{{ old('maps_embed_url', $profile->maps_embed_url) }}</textarea></label>
            </div>
        </section>

        <section class="cms-admin-card cms-form-wide">
            <div class="cms-admin-card-header"><div><span class="cms-card-icon"><i class="fa-solid fa-chart-simple"></i></span><div><h3>Statistik CV</h3><p>Angka pengalaman, proyek, peserta, dan kepuasan klien.</p></div></div></div>
            <div class="cms-form-grid">
                <label>Pengalaman<input name="stat_years_exp" value="{{ old('stat_years_exp', $profile->stat_years_exp ?: '7+ Tahun') }}" required></label>
                <label>Proyek selesai<input name="stat_projects_done" value="{{ old('stat_projects_done', $profile->stat_projects_done ?: '120+') }}" required></label>
                <label>Peserta training<input name="stat_students_trained" value="{{ old('stat_students_trained', $profile->stat_students_trained ?: '500+') }}" required></label>
                <label>Kepuasan klien<input name="stat_client_satisfaction" value="{{ old('stat_client_satisfaction', $profile->stat_client_satisfaction ?: '99.8%') }}" required></label>
            </div>
        </section>

        <section class="cms-admin-card cms-form-wide">
            <div class="cms-admin-card-header"><div><span class="cms-card-icon"><i class="fa-solid fa-share-nodes"></i></span><div><h3>Media Sosial & Footer</h3><p>Tautan dan teks legal website.</p></div></div></div>
            <div class="cms-form-grid">
                <label>GitHub<input type="url" name="github_url" value="{{ old('github_url', $profile->github_url ?: 'https://github.com') }}"></label>
                <label>LinkedIn<input type="url" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url ?: 'https://linkedin.com') }}"></label>
                <label>Instagram<input type="url" name="instagram_url" value="{{ old('instagram_url', $profile->instagram_url ?: 'https://instagram.com') }}"></label>
                <label>YouTube<input type="url" name="youtube_url" value="{{ old('youtube_url', $profile->youtube_url ?: 'https://youtube.com') }}"></label>
                <label>Twitter / X<input type="url" name="twitter_url" value="{{ old('twitter_url', $profile->twitter_url ?: 'https://twitter.com') }}"></label>
                <label>Hak cipta<input name="copyright_text" value="{{ old('copyright_text', $profile->copyright_text ?: 'Ibrahim Digital Portfolio. Hak Cipta Dilindungi.') }}" required></label>
                <label class="cms-form-full">Tentang di footer<textarea name="footer_about" rows="4">{{ old('footer_about', $profile->footer_about) }}</textarea></label>
            </div>
        </section>

        <div class="cms-form-actions"><button type="submit" class="btn-cms-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Seluruh Konten</button></div>
    </form>
@endsection
