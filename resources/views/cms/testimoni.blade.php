@extends('layouts.cms')

@section('title', 'Kelola Apa Kata Mereka - CMS Portofolio')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <h1 class="cms-page-title">Kelola Ulasan "Apa Kata Mereka"</h1>
            <p class="cms-page-desc">Tambah, ubah ulasan, dan upload avatar klien (JPG/JPEG/PNG/SVG ukuran besar s/d 20MB).</p>
        </div>
    </div>

    <!-- Form Tambah Testimoni -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-circle-plus" style="color: #60a5fa;"></i> Tambah Testimoni Baru
        </h2>

        <form action="{{ route('cms.testimoni.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Nama Klien / Siswa *</label>
                    <input type="text" name="name" class="cms-input" placeholder="Contoh: Budi Santoso, S.Kom" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Jabatan / Role *</label>
                    <input type="text" name="role" class="cms-input" placeholder="Contoh: CEO / Junior Developer (Alumni)" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Nama Perusahaan / Institusi</label>
                    <input type="text" name="company" class="cms-input" placeholder="Contoh: PT Digital Nusantara">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Rating Bintang *</label>
                    <select name="rating" class="cms-select" required>
                        <option value="5" selected>⭐⭐⭐⭐⭐ (5 Bintang)</option>
                        <option value="4">⭐⭐⭐⭐ (4 Bintang)</option>
                        <option value="3">⭐⭐⭐ (3 Bintang)</option>
                    </select>
                </div>

                <!-- Upload File Avatar Klien -->
                <div class="cms-form-group full">
                    <label class="cms-form-label">Upload File Foto Avatar Klien (JPG, JPEG, PNG, SVG s/d 20MB)</label>
                    <input type="file" name="avatar_file" class="cms-input" accept=".jpg,.jpeg,.png,.svg,.webp">
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">Isi Ulasan / Testimoni *</label>
                    <textarea name="content" rows="3" class="cms-textarea" placeholder="Tuliskan pengalaman klien bekerjasama atau belajar..." required></textarea>
                </div>
            </div>

            <button type="submit" class="btn-cms-primary" style="margin-top: 10px;">
                <i class="fa-solid fa-plus"></i> Simpan Testimoni Baru
            </button>
        </form>
    </div>

    <!-- Tabel Daftar Testimoni -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-comments" style="color: #34d399;"></i> Daftar Testimoni Klien
        </h2>

        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Nama & Perusahaan</th>
                        <th>Rating</th>
                        <th>Ulasan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $t)
                        <tr>
                            <td>
                                <img src="{{ $t->avatar_url ?? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100' }}" 
                                     alt="{{ $t->name }}" 
                                     style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid #3b82f6;">
                            </td>
                            <td>
                                <strong style="color: #fff;">{{ $t->name }}</strong><br>
                                <span style="font-size: 0.78rem; color: #9ca3af;">{{ $t->role }} {{ $t->company ? '• ' . $t->company : '' }}</span>
                            </td>
                            <td>
                                <span style="color: #fbbf24;">
                                    @for($i = 0; $i < $t->rating; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                </span>
                            </td>
                            <td style="max-width: 320px; font-size: 0.85rem; font-style: italic; color: #cbd5e1;">
                                "{{ $t->content }}"
                            </td>
                            <td>
                                <div class="cms-action-btns">
                                    <button type="button" class="btn-cms-sm btn-cms-edit" onclick="openEditModal({{ $t->id }})">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                    <form action="{{ route('cms.testimoni.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cms-sm btn-cms-delete" title="Hapus Testimoni">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Testimoni -->
                        <div id="edit-modal-{{ $t->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
                            <div style="background: #111827; border: 1px solid #374151; border-radius: 12px; width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; padding: 28px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <h3 style="color: #fff; font-size: 1.25rem;">Edit Testimoni: {{ $t->name }}</h3>
                                    <button type="button" onclick="closeEditModal({{ $t->id }})" style="background: transparent; border: none; color: #9ca3af; font-size: 1.5rem; cursor: pointer;">&times;</button>
                                </div>

                                <form action="{{ route('cms.testimoni.update', $t->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Nama Klien *</label>
                                            <input type="text" name="name" class="cms-input" value="{{ $t->name }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Role / Jabatan *</label>
                                            <input type="text" name="role" class="cms-input" value="{{ $t->role }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Perusahaan</label>
                                            <input type="text" name="company" class="cms-input" value="{{ $t->company }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Rating</label>
                                            <select name="rating" class="cms-select" required>
                                                <option value="5" {{ $t->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Bintang)</option>
                                                <option value="4" {{ $t->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Bintang)</option>
                                                <option value="3" {{ $t->rating == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 Bintang)</option>
                                            </select>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Upload File Foto Avatar Baru (JPG/JPEG/PNG/SVG)</label>
                                            <input type="file" name="avatar_file" class="cms-input" accept=".jpg,.jpeg,.png,.svg,.webp">
                                            @if($t->avatar_url)
                                                <div style="margin-top: 6px;">
                                                    <img src="{{ $t->avatar_url }}" alt="Preview" style="height: 35px; border-radius: 50%;">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Isi Ulasan *</label>
                                            <textarea name="content" rows="3" class="cms-textarea" required>{{ $t->content }}</textarea>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" onclick="closeEditModal({{ $t->id }})" class="btn-cms-sm btn-cms-delete">Batal</button>
                                        <button type="submit" class="btn-cms-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #6b7280; padding: 25px;">Belum ada testimoni.</td>
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
