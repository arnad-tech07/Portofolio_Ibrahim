@extends('layouts.cms')

@section('title', 'Kelola Card Video - CMS Portofolio')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <h1 class="cms-page-title">Kelola Card Video Showcase</h1>
            <p class="cms-page-desc">Tambah, ubah video tutorial, upload thumbnail (JPG/JPEG/PNG/SVG ukuran besar), dan link YouTube.</p>
        </div>
    </div>

    <!-- Form Tambah Video Baru -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-circle-plus" style="color: #60a5fa;"></i> Tambah Card Video Baru
        </h2>

        <form action="{{ route('cms.video.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Judul Video *</label>
                    <input type="text" name="title" class="cms-input" placeholder="Contoh: Walkthrough Fitur Aplikasi POS Kasir" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Kategori Video *</label>
                    <input type="text" name="category" class="cms-input" placeholder="Demo Proyek / Tutorial / Webinar" value="Demo Proyek" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">URL Embed Video (YouTube Embed / Direct Video MP4) *</label>
                    <input type="url" name="video_url" class="cms-input" placeholder="https://www.youtube.com/embed/..." required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Durasi Video</label>
                    <input type="text" name="duration" class="cms-input" placeholder="Contoh: 15:40">
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">Upload File Thumbnail Video (JPG, JPEG, PNG, SVG s/d 20MB)</label>
                    <input type="file" name="thumbnail_file" class="cms-input" accept=".jpg,.jpeg,.png,.svg,.webp">
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">Deskripsi Video *</label>
                    <textarea name="description" rows="3" class="cms-textarea" placeholder="Jelaskan apa yang dibahas dalam video ini..." required></textarea>
                </div>
            </div>

            <button type="submit" class="btn-cms-primary" style="margin-top: 10px;">
                <i class="fa-solid fa-plus"></i> Simpan Video Baru
            </button>
        </form>
    </div>

    <!-- Tabel Daftar Video -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-circle-play" style="color: #34d399;"></i> Daftar Card Video
        </h2>

        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Judul Video</th>
                        <th>Kategori</th>
                        <th>Durasi</th>
                        <th>Tautan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($videos as $v)
                        <tr>
                            <td>
                                <strong style="color: #fff;">{{ $v->title }}</strong><br>
                                <span style="font-size: 0.8rem; color: #9ca3af; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">{{ $v->description }}</span>
                            </td>
                            <td><span class="cms-badge-tag">{{ $v->category }}</span></td>
                            <td><span style="font-size: 0.82rem; color: #fbbf24;"><i class="fa-solid fa-clock"></i> {{ $v->duration ?? '-' }}</span></td>
                            <td>
                                <a href="{{ $v->video_url }}" target="_blank" class="btn-cms-sm btn-cms-edit">
                                    <i class="fa-brands fa-youtube"></i> Tonton
                                </a>
                            </td>
                            <td>
                                <div class="cms-action-btns">
                                    <button type="button" class="btn-cms-sm btn-cms-edit" onclick="openEditModal({{ $v->id }})">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                    <form action="{{ route('cms.video.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Hapus video ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cms-sm btn-cms-delete" title="Hapus Video">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Video -->
                        <div id="edit-modal-{{ $v->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
                            <div style="background: #111827; border: 1px solid #374151; border-radius: 12px; width: 100%; max-width: 650px; max-height: 90vh; overflow-y: auto; padding: 28px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <h3 style="color: #fff; font-size: 1.25rem;">Edit Video: {{ $v->title }}</h3>
                                    <button type="button" onclick="closeEditModal({{ $v->id }})" style="background: transparent; border: none; color: #9ca3af; font-size: 1.5rem; cursor: pointer;">&times;</button>
                                </div>

                                <form action="{{ route('cms.video.update', $v->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Judul Video *</label>
                                            <input type="text" name="title" class="cms-input" value="{{ $v->title }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Kategori *</label>
                                            <input type="text" name="category" class="cms-input" value="{{ $v->category }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">URL Embed Video *</label>
                                            <input type="url" name="video_url" class="cms-input" value="{{ $v->video_url }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Durasi</label>
                                            <input type="text" name="duration" class="cms-input" value="{{ $v->duration }}">
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Upload File Thumbnail Baru (JPG/JPEG/PNG/SVG)</label>
                                            <input type="file" name="thumbnail_file" class="cms-input" accept=".jpg,.jpeg,.png,.svg,.webp">
                                            @if($v->thumbnail_url)
                                                <div style="margin-top: 6px;">
                                                    <img src="{{ $v->thumbnail_url }}" alt="Preview" style="height: 35px; border-radius: 4px;">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Deskripsi Video *</label>
                                            <textarea name="description" rows="3" class="cms-textarea" required>{{ $v->description }}</textarea>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" onclick="closeEditModal({{ $v->id }})" class="btn-cms-sm btn-cms-delete">Batal</button>
                                        <button type="submit" class="btn-cms-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #6b7280; padding: 25px;">Belum ada video showcase.</td>
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
