@extends('layouts.cms')

@section('title', 'Kelola Layanan & Training - CMS Portofolio')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <h1 class="cms-page-title">Kelola Layanan Jasa & Training</h1>
            <p class="cms-page-desc">Tambah, ubah harga, sesuaikan fitur paket website dan program training pemrograman.</p>
        </div>
    </div>

    <!-- Formulir Tambah Layanan Baru -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-circle-plus" style="color: #60a5fa;"></i> Tambah Paket Layanan Baru
        </h2>

        <form action="{{ route('cms.layanan.store') }}" method="POST">
            @csrf
            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Judul Layanan *</label>
                    <input type="text" name="title" class="cms-input" placeholder="Contoh: Website Toko Online Multi-Vendor" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Kategori Layanan *</label>
                    <select name="category" class="cms-select" required>
                        <option value="website">Jasa Pembuatan Website</option>
                        <option value="training">Training Pemrograman</option>
                    </select>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">FontAwesome Icon Class</label>
                    <input type="text" name="icon" class="cms-input" placeholder="fa-solid fa-laptop-code" value="fa-solid fa-code">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Badge Label (Opsional)</label>
                    <input type="text" name="badge" class="cms-input" placeholder="Contoh: Populer, Best Seller, VIP">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Tarif / Harga</label>
                    <input type="text" name="price" class="cms-input" placeholder="Contoh: Mulai Rp 2.500.000 / Sesuai Kebutuhan">
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Status Aktif</label>
                    <div style="margin-top: 8px;">
                        <label style="color: #cbd5e1; cursor: pointer;">
                            <input type="checkbox" name="is_active" value="1" checked> Tampilkan di website publik
                        </label>
                    </div>
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">Deskripsi Singkat *</label>
                    <textarea name="short_desc" rows="2" class="cms-textarea" placeholder="Ringkasan singkat manfaat layanan..." required></textarea>
                </div>

                <div class="cms-form-group full">
                    <label class="cms-form-label">Daftar Fitur / Benefit (Satu baris per poin fitur)</label>
                    <textarea name="features_text" rows="4" class="cms-textarea" placeholder="Desain Responsif Mobile&#10;Gratis Domain & Hosting 1 Tahun&#10;Optimasi Kecepatan & SEO"></textarea>
                </div>
            </div>

            <button type="submit" class="btn-cms-primary" style="margin-top: 10px;">
                <i class="fa-solid fa-plus"></i> Simpan Layanan Baru
            </button>
        </form>
    </div>

    <!-- Tabel Daftar Layanan -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-list-check" style="color: #34d399;"></i> Daftar Layanan Aktif
        </h2>

        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Ikon & Judul</th>
                        <th>Kategori</th>
                        <th>Badge</th>
                        <th>Tarif</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $srv)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 36px; height: 36px; background: rgba(59, 130, 246, 0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #60a5fa;">
                                        <i class="{{ $srv->icon ?? 'fa-solid fa-code' }}"></i>
                                    </div>
                                    <div>
                                        <strong style="color: #fff;">{{ $srv->title }}</strong>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="cms-badge-tag {{ $srv->category == 'training' ? 'unread' : '' }}" style="{{ $srv->category == 'training' ? 'background: rgba(14, 165, 233, 0.2); color: #38bdf8;' : '' }}">
                                    {{ $srv->category == 'training' ? 'Training Pemrograman' : 'Jasa Website' }}
                                </span>
                            </td>
                            <td>{{ $srv->badge ?? '-' }}</td>
                            <td><strong style="color: #34d399;">{{ $srv->price ?? '-' }}</strong></td>
                            <td>
                                @if($srv->is_active)
                                    <span class="cms-badge-tag read">Aktif</span>
                                @else
                                    <span class="cms-badge-tag unread">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="cms-action-btns">
                                    <button type="button" class="btn-cms-sm btn-cms-edit" onclick="openEditModal({{ $srv->id }})">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                    <form action="{{ route('cms.layanan.destroy', $srv->id) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cms-sm btn-cms-delete" title="Hapus Layanan">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Layanan -->
                        <div id="edit-modal-{{ $srv->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
                            <div style="background: #111827; border: 1px solid #374151; border-radius: 12px; width: 100%; max-width: 650px; max-height: 90vh; overflow-y: auto; padding: 28px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <h3 style="color: #fff; font-size: 1.25rem;">Edit Layanan: {{ $srv->title }}</h3>
                                    <button type="button" onclick="closeEditModal({{ $srv->id }})" style="background: transparent; border: none; color: #9ca3af; font-size: 1.5rem; cursor: pointer;">&times;</button>
                                </div>

                                <form action="{{ route('cms.layanan.update', $srv->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Judul Layanan *</label>
                                            <input type="text" name="title" class="cms-input" value="{{ $srv->title }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Kategori Layanan *</label>
                                            <select name="category" class="cms-select" required>
                                                <option value="website" {{ $srv->category == 'website' ? 'selected' : '' }}>Jasa Pembuatan Website</option>
                                                <option value="training" {{ $srv->category == 'training' ? 'selected' : '' }}>Training Pemrograman</option>
                                            </select>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Icon FontAwesome</label>
                                            <input type="text" name="icon" class="cms-input" value="{{ $srv->icon }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Badge Label</label>
                                            <input type="text" name="badge" class="cms-input" value="{{ $srv->badge }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Tarif / Harga</label>
                                            <input type="text" name="price" class="cms-input" value="{{ $srv->price }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Status Aktif</label>
                                            <div style="margin-top: 8px;">
                                                <label style="color: #cbd5e1; cursor: pointer;">
                                                    <input type="checkbox" name="is_active" value="1" {{ $srv->is_active ? 'checked' : '' }}> Tampilkan di website publik
                                                </label>
                                            </div>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Deskripsi Singkat</label>
                                            <textarea name="short_desc" rows="2" class="cms-textarea">{{ $srv->short_desc }}</textarea>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Fitur / Benefit (Satu baris per poin)</label>
                                            <textarea name="features_text" rows="4" class="cms-textarea">{{ is_array($srv->features) ? implode("\n", $srv->features) : '' }}</textarea>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" onclick="closeEditModal({{ $srv->id }})" class="btn-cms-sm btn-cms-delete">Batal</button>
                                        <button type="submit" class="btn-cms-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #6b7280; padding: 25px;">Belum ada layanan.</td>
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
