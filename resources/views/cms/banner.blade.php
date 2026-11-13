@extends('layouts.cms')

@section('title', 'Kelola Slide Banner Carousel - CMS Portofolio')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <h1 class="cms-page-title">Kelola Slide Banner Carousel</h1>
            <p class="cms-page-desc">Tambah, ubah judul, teks sorotan, tombol aksi, dan visual kartu pada banner utama beranda.</p>
        </div>
    </div>

    <!-- Form Tambah Slide Banner Baru -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-circle-plus" style="color: #60a5fa;"></i> Tambah Slide Banner Baru
        </h2>

        <form action="{{ route('cms.banner.store') }}" method="POST">
            @csrf
            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Badge Label Atas *</label>
                    <input type="text" name="badge_text" class="cms-input" placeholder="Contoh: Solusi Digital Bisnis" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Judul Utama Slide *</label>
                    <input type="text" name="title" class="cms-input" placeholder="Contoh: Jasa Pembuatan Website" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Teks Sorotan Berwarna (Highlight Gradient)</label>
                    <input type="text" name="highlight_text" class="cms-input" placeholder="Contoh: Elegan, Cepat & Bergaransi">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Tema Gradient Background *</label>
                    <select name="bg_gradient" class="cms-select" required>
                        <option value="slide-bg-1">Biru Gelap (Blue Dark Gradient)</option>
                        <option value="slide-bg-2">Ungu Indigo (Purple Indigo Gradient)</option>
                        <option value="slide-bg-3">Teal Cyan (Cyan Dark Gradient)</option>
                    </select>
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">Deskripsi Paragraf Slide *</label>
                    <textarea name="description" rows="3" class="cms-textarea" placeholder="Tuliskan kalimat penjelas slide..." required></textarea>
                </div>

                <!-- Tombol 1 -->
                <div class="cms-form-group">
                    <label class="cms-form-label">Teks Tombol Utama</label>
                    <input type="text" name="button1_text" class="cms-input" placeholder="Lihat CV / Paket Harga">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Tautan Tombol Utama (URL)</label>
                    <input type="text" name="button1_url" class="cms-input" placeholder="#layanan-section / https://...">
                </div>

                <!-- Tombol 2 -->
                <div class="cms-form-group">
                    <label class="cms-form-label">Teks Tombol Sekunder</label>
                    <input type="text" name="button2_text" class="cms-input" placeholder="Konsultasi Gratis / Tonton Video">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Tautan Tombol Sekunder (URL)</label>
                    <input type="text" name="button2_url" class="cms-input" placeholder="#video-section / https://wa.me/...">
                </div>

                <!-- Visual Kartu Mockup Kanan -->
                <div class="cms-form-group">
                    <label class="cms-form-label">Ikon Visual Kartu (FontAwesome)</label>
                    <input type="text" name="mockup_icon" class="cms-input" placeholder="fa-solid fa-laptop-code" value="fa-solid fa-code">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Judul Visual Kartu Mockup</label>
                    <input type="text" name="mockup_title" class="cms-input" placeholder="Arsitektur Modern / Performa Tinggi">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Statistik Kartu 1 (Nilai & Label)</label>
                    <div style="display: flex; gap: 8px;">
                        <input type="text" name="mockup_stat1_val" class="cms-input" placeholder="Nilai: 120+" style="width: 45%;">
                        <input type="text" name="mockup_stat1_label" class="cms-input" placeholder="Label: Proyek Selesai" style="width: 55%;">
                    </div>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Statistik Kartu 2 (Nilai & Label)</label>
                    <div style="display: flex; gap: 8px;">
                        <input type="text" name="mockup_stat2_val" class="cms-input" placeholder="Nilai: 500+" style="width: 45%;">
                        <input type="text" name="mockup_stat2_label" class="cms-input" placeholder="Label: Siswa Training" style="width: 55%;">
                    </div>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Status Tayang</label>
                    <div style="margin-top: 8px;">
                        <label style="color: #cbd5e1; cursor: pointer;">
                            <input type="checkbox" name="is_active" value="1" checked> Aktifkan slide di banner carousel
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-cms-primary" style="margin-top: 10px;">
                <i class="fa-solid fa-plus"></i> Simpan Slide Banner
            </button>
        </form>
    </div>

    <!-- Tabel Daftar Slide Banner -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-images" style="color: #34d399;"></i> Daftar Slide Banner Aktif
        </h2>

        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Badge & Judul Slide</th>
                        <th>Teks Sorotan</th>
                        <th>Tombol Aksi</th>
                        <th>Tema</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $slide)
                        <tr>
                            <td>
                                <span class="cms-badge-tag" style="margin-bottom: 4px;">{{ $slide->badge_text }}</span><br>
                                <strong style="color: #fff;">{{ $slide->title }}</strong>
                            </td>
                            <td>
                                <span style="color: #38bdf8;">{{ $slide->highlight_text ?? '-' }}</span>
                            </td>
                            <td style="font-size: 0.8rem; color: #cbd5e1;">
                                {{ $slide->button1_text ?? '-' }} | {{ $slide->button2_text ?? '-' }}
                            </td>
                            <td>
                                <span class="cms-badge-tag">{{ $slide->bg_gradient }}</span>
                            </td>
                            <td>
                                @if($slide->is_active)
                                    <span class="cms-badge-tag read">Aktif</span>
                                @else
                                    <span class="cms-badge-tag unread">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="cms-action-btns">
                                    <button type="button" class="btn-cms-sm btn-cms-edit" onclick="openEditModal({{ $slide->id }})">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                    <form action="{{ route('cms.banner.destroy', $slide->id) }}" method="POST" onsubmit="return confirm('Hapus slide ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cms-sm btn-cms-delete" title="Hapus Slide">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Slide Inline -->
                        <div id="edit-modal-{{ $slide->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
                            <div style="background: #111827; border: 1px solid #374151; border-radius: 12px; width: 100%; max-width: 700px; max-height: 90vh; overflow-y: auto; padding: 28px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <h3 style="color: #fff; font-size: 1.25rem;">Edit Slide: {{ $slide->title }}</h3>
                                    <button type="button" onclick="closeEditModal({{ $slide->id }})" style="background: transparent; border: none; color: #9ca3af; font-size: 1.5rem; cursor: pointer;">&times;</button>
                                </div>

                                <form action="{{ route('cms.banner.update', $slide->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Badge Label</label>
                                            <input type="text" name="badge_text" class="cms-input" value="{{ $slide->badge_text }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Judul Utama</label>
                                            <input type="text" name="title" class="cms-input" value="{{ $slide->title }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Teks Sorotan</label>
                                            <input type="text" name="highlight_text" class="cms-input" value="{{ $slide->highlight_text }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Tema Gradient</label>
                                            <select name="bg_gradient" class="cms-select" required>
                                                <option value="slide-bg-1" {{ $slide->bg_gradient == 'slide-bg-1' ? 'selected' : '' }}>Biru Gelap</option>
                                                <option value="slide-bg-2" {{ $slide->bg_gradient == 'slide-bg-2' ? 'selected' : '' }}>Ungu Indigo</option>
                                                <option value="slide-bg-3" {{ $slide->bg_gradient == 'slide-bg-3' ? 'selected' : '' }}>Teal Cyan</option>
                                            </select>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Deskripsi</label>
                                            <textarea name="description" rows="3" class="cms-textarea" required>{{ $slide->description }}</textarea>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Teks Tombol 1</label>
                                            <input type="text" name="button1_text" class="cms-input" value="{{ $slide->button1_text }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">URL Tombol 1</label>
                                            <input type="text" name="button1_url" class="cms-input" value="{{ $slide->button1_url }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Teks Tombol 2</label>
                                            <input type="text" name="button2_text" class="cms-input" value="{{ $slide->button2_text }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">URL Tombol 2</label>
                                            <input type="text" name="button2_url" class="cms-input" value="{{ $slide->button2_url }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Status Aktif</label>
                                            <div style="margin-top: 8px;">
                                                <label style="color: #cbd5e1; cursor: pointer;">
                                                    <input type="checkbox" name="is_active" value="1" {{ $slide->is_active ? 'checked' : '' }}> Tampilkan di banner carousel
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" onclick="closeEditModal({{ $slide->id }})" class="btn-cms-sm btn-cms-delete">Batal</button>
                                        <button type="submit" class="btn-cms-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #6b7280; padding: 25px;">Belum ada slide banner.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function openEditModal(id) {
            document.getElementById('edit-modal-' + id).style.display = 'flex';
        }
        function closeEditModal(id) {
            document.getElementById('edit-modal-' + id).style.display = 'none';
        }
    </script>
@endsection

