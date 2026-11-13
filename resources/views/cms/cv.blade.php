@extends('layouts.cms')

@section('title', 'Kelola Isi CV (Karir, Skill & Sertifikasi) - CMS Portofolio')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <h1 class="cms-page-title">Kelola Konten CV Digital Ibrahim</h1>
            <p class="cms-page-desc">Tambah, ubah (edit), atau hapus daftar pengalaman karir, keahlian teknis (skill bar), sertifikasi, dan riwayat pendidikan.</p>
        </div>
    </div>

    <!-- BAGIAN 1: PENGALAMAN KERJA (KARIR) -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-briefcase" style="color: #60a5fa;"></i> 1. Riwayat Pengalaman Kerja (Timeline Karir)
        </h2>

        <!-- Form Tambah Pengalaman -->
        <form action="{{ route('cms.pengalaman.store') }}" method="POST" style="margin-bottom: 24px; padding: 18px; background: rgba(255,255,255,0.03); border-radius: 8px; border: 1px dashed rgba(255,255,255,0.15);">
            @csrf
            <h4 style="color: #cbd5e1; font-size: 0.95rem; margin-bottom: 12px;">+ Tambah Pengalaman Kerja Baru</h4>
            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Periode / Tahun *</label>
                    <input type="text" name="period" class="cms-input" placeholder="Contoh: 2023 - Sekarang" required>
                </div>
                <div class="cms-form-group">
                    <label class="cms-form-label">Posisi / Jabatan *</label>
                    <input type="text" name="role" class="cms-input" placeholder="Contoh: Lead Web Architect" required>
                </div>
                <div class="cms-form-group full">
                    <label class="cms-form-label">Nama Perusahaan / Agensi *</label>
                    <input type="text" name="company" class="cms-input" placeholder="Contoh: PT Digital Solusindo" required>
                </div>
                <div class="cms-form-group full">
                    <label class="cms-form-label">Deskripsi Pekerjaan / Pencapaian *</label>
                    <textarea name="description" rows="2" class="cms-textarea" placeholder="Jelaskan peran, tanggung jawab, dan teknologi yang digunakan..." required></textarea>
                </div>
            </div>
            <button type="submit" class="btn-cms-primary" style="margin-top: 6px;">
                <i class="fa-solid fa-plus"></i> Tambah Pengalaman
            </button>
        </form>

        <!-- Tabel Pengalaman -->
        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Posisi & Perusahaan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($experiences as $exp)
                        <tr>
                            <td><span class="cms-badge-tag">{{ $exp->period }}</span></td>
                            <td>
                                <strong style="color: #fff;">{{ $exp->role }}</strong><br>
                                <span style="font-size: 0.8rem; color: #9ca3af;">{{ $exp->company }}</span>
                            </td>
                            <td style="max-width: 380px; font-size: 0.82rem; color: #cbd5e1;">
                                {{ $exp->description }}
                            </td>
                            <td>
                                <div class="cms-action-btns">
                                    <button type="button" class="btn-cms-sm btn-cms-edit" onclick="openModal('edit-exp-{{ $exp->id }}')">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                    <form action="{{ route('cms.pengalaman.destroy', $exp->id) }}" method="POST" onsubmit="return confirm('Hapus pengalaman kerja ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cms-sm btn-cms-delete" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Pengalaman -->
                        <div id="edit-exp-{{ $exp->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
                            <div style="background: #111827; border: 1px solid #374151; border-radius: 12px; width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; padding: 26px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <h3 style="color: #fff; font-size: 1.2rem;">Edit Pengalaman: {{ $exp->role }}</h3>
                                    <button type="button" onclick="closeModal('edit-exp-{{ $exp->id }}')" style="background: transparent; border: none; color: #9ca3af; font-size: 1.5rem; cursor: pointer;">&times;</button>
                                </div>
                                <form action="{{ route('cms.pengalaman.update', $exp->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Periode</label>
                                            <input type="text" name="period" class="cms-input" value="{{ $exp->period }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Posisi / Jabatan</label>
                                            <input type="text" name="role" class="cms-input" value="{{ $exp->role }}" required>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Perusahaan</label>
                                            <input type="text" name="company" class="cms-input" value="{{ $exp->company }}" required>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Deskripsi Pekerjaan</label>
                                            <textarea name="description" rows="3" class="cms-textarea" required>{{ $exp->description }}</textarea>
                                        </div>
                                    </div>
                                    <div style="margin-top: 18px; display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" onclick="closeModal('edit-exp-{{ $exp->id }}')" class="btn-cms-sm btn-cms-delete">Batal</button>
                                        <button type="submit" class="btn-cms-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #6b7280; padding: 15px;">Belum ada pengalaman kerja.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- BAGIAN 2: KEAHLIAN TEKNIS (SKILLS) -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-gears" style="color: #34d399;"></i> 2. Keahlian Teknis & Skill Bar (%)
        </h2>

        <!-- Form Tambah Skill -->
        <form action="{{ route('cms.skill.store') }}" method="POST" style="margin-bottom: 24px; padding: 18px; background: rgba(255,255,255,0.03); border-radius: 8px; border: 1px dashed rgba(255,255,255,0.15);">
            @csrf
            <h4 style="color: #cbd5e1; font-size: 0.95rem; margin-bottom: 12px;">+ Tambah Keahlian Baru</h4>
            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Nama Keahlian / Tech Stack *</label>
                    <input type="text" name="name" class="cms-input" placeholder="Contoh: PHP & Laravel Framework" required>
                </div>
                <div class="cms-form-group">
                    <label class="cms-form-label">Persentase Penguasaan (1 - 100) *</label>
                    <input type="number" name="percentage" class="cms-input" min="1" max="100" value="95" required>
                </div>
                <div class="cms-form-group">
                    <label class="cms-form-label">Ikon FontAwesome (Opsional)</label>
                    <input type="text" name="icon" class="cms-input" placeholder="fa-brands fa-laravel" value="fa-solid fa-code">
                </div>
                <div class="cms-form-group">
                    <label class="cms-form-label">Kategori</label>
                    <input type="text" name="category" class="cms-input" value="Core Stack" placeholder="Core Stack / Tool">
                </div>
            </div>
            <button type="submit" class="btn-cms-primary" style="margin-top: 6px;">
                <i class="fa-solid fa-plus"></i> Tambah Keahlian
            </button>
        </form>

        <!-- Tabel Skill -->
        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Nama Keahlian</th>
                        <th>Persentase</th>
                        <th>Preview Progress Bar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skills as $sk)
                        <tr>
                            <td>
                                @if($sk->icon) <i class="{{ $sk->icon }}" style="color: #60a5fa; margin-right: 6px;"></i> @endif
                                <strong style="color: #fff;">{{ $sk->name }}</strong>
                            </td>
                            <td><strong style="color: #34d399;">{{ $sk->percentage }}%</strong></td>
                            <td style="width: 200px;">
                                <div style="background: #374151; height: 8px; border-radius: 4px; overflow: hidden;">
                                    <div style="background: linear-gradient(135deg, #3b82f6, #06b6d4); width: {{ $sk->percentage }}%; height: 100%;"></div>
                                </div>
                            </td>
                            <td>
                                <div class="cms-action-btns">
                                    <button type="button" class="btn-cms-sm btn-cms-edit" onclick="openModal('edit-skill-{{ $sk->id }}')">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                    <form action="{{ route('cms.skill.destroy', $sk->id) }}" method="POST" onsubmit="return confirm('Hapus skill ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cms-sm btn-cms-delete" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Skill -->
                        <div id="edit-skill-{{ $sk->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
                            <div style="background: #111827; border: 1px solid #374151; border-radius: 12px; width: 100%; max-width: 550px; max-height: 90vh; overflow-y: auto; padding: 26px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <h3 style="color: #fff; font-size: 1.2rem;">Edit Skill: {{ $sk->name }}</h3>
                                    <button type="button" onclick="closeModal('edit-skill-{{ $sk->id }}')" style="background: transparent; border: none; color: #9ca3af; font-size: 1.5rem; cursor: pointer;">&times;</button>
                                </div>
                                <form action="{{ route('cms.skill.update', $sk->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Nama Keahlian</label>
                                            <input type="text" name="name" class="cms-input" value="{{ $sk->name }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Persentase (1 - 100)</label>
                                            <input type="number" name="percentage" class="cms-input" min="1" max="100" value="{{ $sk->percentage }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Ikon</label>
                                            <input type="text" name="icon" class="cms-input" value="{{ $sk->icon }}">
                                        </div>
                                    </div>
                                    <div style="margin-top: 18px; display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" onclick="closeModal('edit-skill-{{ $sk->id }}')" class="btn-cms-sm btn-cms-delete">Batal</button>
                                        <button type="submit" class="btn-cms-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #6b7280; padding: 15px;">Belum ada skill.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- BAGIAN 3: SERTIFIKASI PROFESIONAL -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-award" style="color: #fbbf24;"></i> 3. Sertifikasi Profesional
        </h2>

        <!-- Form Tambah Sertifikasi -->
        <form action="{{ route('cms.sertifikasi.store') }}" method="POST" style="margin-bottom: 24px; padding: 18px; background: rgba(255,255,255,0.03); border-radius: 8px; border: 1px dashed rgba(255,255,255,0.15);">
            @csrf
            <h4 style="color: #cbd5e1; font-size: 0.95rem; margin-bottom: 12px;">+ Tambah Sertifikasi Baru</h4>
            <div class="cms-form-grid">
                <div class="cms-form-group">
                    <label class="cms-form-label">Nama Sertifikasi *</label>
                    <input type="text" name="title" class="cms-input" placeholder="Contoh: Certified Laravel Expert Developer" required>
                </div>
                <div class="cms-form-group">
                    <label class="cms-form-label">Penerbit / Lembaga *</label>
                    <input type="text" name="issuer" class="cms-input" placeholder="Contoh: Laravel Certification Authority" required>
                </div>
                <div class="cms-form-group">
                    <label class="cms-form-label">Tahun</label>
                    <input type="text" name="year" class="cms-input" placeholder="Contoh: 2024">
                </div>
                <div class="cms-form-group">
                    <label class="cms-form-label">Warna Ikon (HEX)</label>
                    <input type="text" name="icon_color" class="cms-input" value="#f59e0b" placeholder="#f59e0b">
                </div>
            </div>
            <button type="submit" class="btn-cms-primary" style="margin-top: 6px;">
                <i class="fa-solid fa-plus"></i> Tambah Sertifikasi
            </button>
        </form>

        <!-- Tabel Sertifikasi -->
        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Judul Sertifikasi</th>
                        <th>Lembaga Penerbit</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($certifications as $cert)
                        <tr>
                            <td>
                                <i class="{{ $cert->icon ?? 'fa-solid fa-award' }}" style="color: {{ $cert->icon_color ?? '#f59e0b' }}; margin-right: 8px;"></i>
                                <strong style="color: #fff;">{{ $cert->title }}</strong>
                            </td>
                            <td>{{ $cert->issuer }}</td>
                            <td>{{ $cert->year ?? '-' }}</td>
                            <td>
                                <div class="cms-action-btns">
                                    <button type="button" class="btn-cms-sm btn-cms-edit" onclick="openModal('edit-cert-{{ $cert->id }}')">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                    <form action="{{ route('cms.sertifikasi.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Hapus sertifikasi ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cms-sm btn-cms-delete" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Sertifikasi -->
                        <div id="edit-cert-{{ $cert->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
                            <div style="background: #111827; border: 1px solid #374151; border-radius: 12px; width: 100%; max-width: 550px; max-height: 90vh; overflow-y: auto; padding: 26px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <h3 style="color: #fff; font-size: 1.2rem;">Edit Sertifikasi: {{ $cert->title }}</h3>
                                    <button type="button" onclick="closeModal('edit-cert-{{ $cert->id }}')" style="background: transparent; border: none; color: #9ca3af; font-size: 1.5rem; cursor: pointer;">&times;</button>
                                </div>
                                <form action="{{ route('cms.sertifikasi.update', $cert->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Nama Sertifikasi</label>
                                            <input type="text" name="title" class="cms-input" value="{{ $cert->title }}" required>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Lembaga Penerbit</label>
                                            <input type="text" name="issuer" class="cms-input" value="{{ $cert->issuer }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Tahun</label>
                                            <input type="text" name="year" class="cms-input" value="{{ $cert->year }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Warna Ikon (HEX)</label>
                                            <input type="text" name="icon_color" class="cms-input" value="{{ $cert->icon_color }}">
                                        </div>
                                    </div>
                                    <div style="margin-top: 18px; display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" onclick="closeModal('edit-cert-{{ $cert->id }}')" class="btn-cms-sm btn-cms-delete">Batal</button>
                                        <button type="submit" class="btn-cms-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #6b7280; padding: 15px;">Belum ada sertifikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- BAGIAN 4: RIWAYAT PENDIDIKAN FORMAL -->
    <div class="cms-panel-card">
        <h2 class="cms-panel-title" style="margin-bottom: 16px;">
            <i class="fa-solid fa-graduation-cap" style="color: #a855f7;"></i> 4. Riwayat Pendidikan Formal
        </h2>

        <!-- Form Tambah Pendidikan -->
        <form action="{{ route('cms.pendidikan.store') }}" method="POST" style="margin-bottom: 24px; padding: 18px; background: rgba(255,255,255,0.03); border-radius: 8px; border: 1px dashed rgba(255,255,255,0.15);">
            @csrf
            <h4 style="color: #cbd5e1; font-size: 0.95rem; margin-bottom: 12px;">+ Tambah Riwayat Pendidikan Baru</h4>
            <div class="cms-form-grid">
                <div class="cms-form-group full">
                    <label class="cms-form-label">Gelar / Jurusan *</label>
                    <input type="text" name="degree" class="cms-input" placeholder="Contoh: Sarjana Komputer (S.Kom) - Teknik Informatika" required>
                </div>
                <div class="cms-form-group">
                    <label class="cms-form-label">Nama Universitas / Sekolah *</label>
                    <input type="text" name="institution" class="cms-input" placeholder="Contoh: Universitas Indonesia" required>
                </div>
                <div class="cms-form-group">
                    <label class="cms-form-label">Keterangan / Predikat / Tahun</label>
                    <input type="text" name="year_graduated" class="cms-input" placeholder="Contoh: Lulus Cumlaude • 2020">
                </div>
            </div>
            <button type="submit" class="btn-cms-primary" style="margin-top: 6px;">
                <i class="fa-solid fa-plus"></i> Tambah Pendidikan
            </button>
        </form>

        <!-- Tabel Pendidikan -->
        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Gelar / Jurusan</th>
                        <th>Institusi Kampus</th>
                        <th>Keterangan / Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($educations as $edu)
                        <tr>
                            <td>
                                <i class="fa-solid fa-university" style="color: #3b82f6; margin-right: 8px;"></i>
                                <strong style="color: #fff;">{{ $edu->degree }}</strong>
                            </td>
                            <td>{{ $edu->institution }}</td>
                            <td>{{ $edu->year_graduated ?? '-' }}</td>
                            <td>
                                <div class="cms-action-btns">
                                    <button type="button" class="btn-cms-sm btn-cms-edit" onclick="openModal('edit-edu-{{ $edu->id }}')">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                    <form action="{{ route('cms.pendidikan.destroy', $edu->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat pendidikan ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cms-sm btn-cms-delete" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Pendidikan -->
                        <div id="edit-edu-{{ $edu->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
                            <div style="background: #111827; border: 1px solid #374151; border-radius: 12px; width: 100%; max-width: 550px; max-height: 90vh; overflow-y: auto; padding: 26px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <h3 style="color: #fff; font-size: 1.2rem;">Edit Pendidikan</h3>
                                    <button type="button" onclick="closeModal('edit-edu-{{ $edu->id }}')" style="background: transparent; border: none; color: #9ca3af; font-size: 1.5rem; cursor: pointer;">&times;</button>
                                </div>
                                <form action="{{ route('cms.pendidikan.update', $edu->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Gelar / Jurusan</label>
                                            <input type="text" name="degree" class="cms-input" value="{{ $edu->degree }}" required>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Nama Institusi</label>
                                            <input type="text" name="institution" class="cms-input" value="{{ $edu->institution }}" required>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Keterangan / Tahun</label>
                                            <input type="text" name="year_graduated" class="cms-input" value="{{ $edu->year_graduated }}">
                                        </div>
                                    </div>
                                    <div style="margin-top: 18px; display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" onclick="closeModal('edit-edu-{{ $edu->id }}')" class="btn-cms-sm btn-cms-delete">Batal</button>
                                        <button type="submit" class="btn-cms-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #6b7280; padding: 15px;">Belum ada riwayat pendidikan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>
@endsection
