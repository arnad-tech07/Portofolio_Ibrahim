@extends('layouts.cms')

@section('title', 'Kelola Card Dokumentasi - CMS Portofolio')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <h1 class="cms-page-title">Kelola Card Dokumentasi Proyek</h1>
            <p class="cms-page-desc">Tambah, ubah data proyek, atau upload gambar dokumentasi (JPG/JPEG/PNG/SVG ukuran besar s/d 20MB).</p>
        </div>
    </div>

    <!-- Form Tambah Dokumentasi Proyek -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-circle-plus" style="color: #60a5fa;"></i> Tambah Dokumentasi Proyek Baru
        </h2>

        <form action="{{ route('cms.proyek.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Judul Dokumentasi Proyek *</label>
                    <input type="text" name="title" class="cms-input" placeholder="Contoh: Sistem Informasi Manajemen RS (SIMRS)" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Kategori Proyek *</label>
                    <input type="text" name="category" class="cms-input" placeholder="Contoh: Web Application / E-Commerce / Company Profile" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Nama Klien / Perusahaan</label>
                    <input type="text" name="client" class="cms-input" placeholder="Contoh: RSUD Bhakti Sehat / PT Mitra Mandiri">
                </div>

                <!-- Upload File Gambar Screenshot JPG/JPEG/PNG/SVG -->
                <div class="cms-form-group">
                    <label class="cms-form-label">Upload File Foto Proyek (JPG, JPEG, PNG, SVG s/d 20MB)</label>
                    <input type="file" name="image_file" class="cms-input" accept=".jpg,.jpeg,.png,.svg,.webp">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Tech Stack (Pisahkan dengan koma)</label>
                    <input type="text" name="tech_stack" class="cms-input" placeholder="Laravel 12, Livewire, MySQL, Tailwind CSS">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">URL Demo Live (Opsional)</label>
                    <input type="url" name="demo_url" class="cms-input" placeholder="https://demo-proyek.com">
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">URL Repositori GitHub (Opsional)</label>
                    <input type="url" name="github_url" class="cms-input" placeholder="https://github.com/ibrahim/proyek">
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">Deskripsi Lengkap Dokumentasi Proyek *</label>
                    <textarea name="description" rows="4" class="cms-textarea" placeholder="Jelaskan tantangan, arsitektur, dan fitur kunci sistem yang dibangun..." required></textarea>
                </div>
            </div>

            <button type="submit" class="btn-cms-primary" style="margin-top: 10px;">
                <i class="fa-solid fa-plus"></i> Simpan Dokumentasi Proyek
            </button>
        </form>
    </div>

    <!-- Tabel Daftar Proyek -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-folder-open" style="color: #34d399;"></i> Daftar Dokumentasi Proyek
        </h2>

        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Judul & Klien</th>
                        <th>Kategori</th>
                        <th>Tech Stack</th>
                        <th>Tautan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $p)
                        <tr>
                            <td>
                                <img src="{{ $p->image_url ?? 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=100' }}" 
                                     alt="{{ $p->title }}" 
                                     style="width: 50px; height: 35px; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td>
                                <strong style="color: #fff;">{{ $p->title }}</strong><br>
                                <span style="font-size: 0.78rem; color: #9ca3af;">{{ $p->client ?? 'Proyek Mandiri' }}</span>
                            </td>
                            <td><span class="cms-badge-tag">{{ $p->category }}</span></td>
                            <td style="font-size: 0.8rem; color: #9ca3af;">{{ $p->tech_stack }}</td>
                            <td>
                                @if($p->demo_url)
                                    <a href="{{ $p->demo_url }}" target="_blank" style="color: #60a5fa; margin-right: 8px;"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                @endif
                                @if($p->github_url)
                                    <a href="{{ $p->github_url }}" target="_blank" style="color: #cbd5e1;"><i class="fa-brands fa-github"></i></a>
                                @endif
                            </td>
                            <td>
                                <div class="cms-action-btns">
                                    <button type="button" class="btn-cms-sm btn-cms-edit" onclick="openEditModal({{ $p->id }})">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                    <form action="{{ route('cms.proyek.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus dokumentasi proyek ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cms-sm btn-cms-delete" title="Hapus Proyek">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Proyek -->
                        <div id="edit-modal-{{ $p->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
                            <div style="background: #111827; border: 1px solid #374151; border-radius: 12px; width: 100%; max-width: 650px; max-height: 90vh; overflow-y: auto; padding: 28px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <h3 style="color: #fff; font-size: 1.25rem;">Edit Proyek: {{ $p->title }}</h3>
                                    <button type="button" onclick="closeEditModal({{ $p->id }})" style="background: transparent; border: none; color: #9ca3af; font-size: 1.5rem; cursor: pointer;">&times;</button>
                                </div>

                                <form action="{{ route('cms.proyek.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Judul Proyek *</label>
                                            <input type="text" name="title" class="cms-input" value="{{ $p->title }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Kategori *</label>
                                            <input type="text" name="category" class="cms-input" value="{{ $p->category }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Nama Klien</label>
                                            <input type="text" name="client" class="cms-input" value="{{ $p->client }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Upload File Foto Baru (JPG/JPEG/PNG/SVG)</label>
                                            <input type="file" name="image_file" class="cms-input" accept=".jpg,.jpeg,.png,.svg,.webp">
                                            @if($p->image_url)
                                                <div style="margin-top: 6px;">
                                                    <img src="{{ $p->image_url }}" alt="Preview" style="height: 35px; border-radius: 4px;">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Tech Stack</label>
                                            <input type="text" name="tech_stack" class="cms-input" value="{{ $p->tech_stack }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">URL Demo Live</label>
                                            <input type="url" name="demo_url" class="cms-input" value="{{ $p->demo_url }}">
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">URL GitHub</label>
                                            <input type="url" name="github_url" class="cms-input" value="{{ $p->github_url }}">
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Deskripsi Lengkap *</label>
                                            <textarea name="description" rows="4" class="cms-textarea" required>{{ $p->description }}</textarea>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" onclick="closeEditModal({{ $p->id }})" class="btn-cms-sm btn-cms-delete">Batal</button>
                                        <button type="submit" class="btn-cms-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #6b7280; padding: 25px;">Belum ada dokumentasi proyek.</td>
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
