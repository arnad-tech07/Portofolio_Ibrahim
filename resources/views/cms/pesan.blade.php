@extends('layouts.cms')

@section('title', 'Pesan Kontak - CMS Portofolio Ibrahim')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <h1 class="cms-page-title">Pesan Masuk dari Formulir Kontak</h1>
            <p class="cms-page-desc">Kelola, baca, ubah catatan internal, dan tindak lanjuti pesan yang dikirim oleh pengunjung.</p>
        </div>
    </div>

    <div class="cms-panel-card">
        <div class="cms-table-responsive">
            <table class="cms-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Pengirim</th>
                        <th>Layanan</th>
                        <th>Detail Pesan & Catatan</th>
                        <th>Waktu Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr>
                            <td>
                                @if(!$msg->is_read)
                                    <span class="cms-badge-tag unread">Baru</span>
                                @else
                                    <span class="cms-badge-tag read">Dibaca</span>
                                @endif
                            </td>
                            <td>
                                <strong style="color: #fff;">{{ $msg->nama }}</strong><br>
                                <span style="font-size: 0.8rem; color: #9ca3af;"><i class="fa-solid fa-envelope"></i> {{ $msg->email }}</span><br>
                                @if($msg->telepon)
                                    <span style="font-size: 0.8rem; color: #34d399;"><i class="fa-brands fa-whatsapp"></i> {{ $msg->telepon }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="cms-badge-tag">{{ $msg->layanan ?? 'Umum' }}</span>
                            </td>
                            <td style="max-width: 360px; line-height: 1.5;">
                                <div style="background: rgba(255, 255, 255, 0.03); padding: 10px 14px; border-radius: 6px; font-size: 0.85rem; color: #e2e8f0; border-left: 3px solid #3b82f6;">
                                    {{ $msg->pesan }}
                                </div>
                                @if($msg->admin_note)
                                    <div style="margin-top: 6px; font-size: 0.78rem; color: #fbbf24; background: rgba(245, 158, 11, 0.1); padding: 4px 8px; border-radius: 4px;">
                                        <i class="fa-solid fa-note-sticky"></i> <strong>Catatan:</strong> {{ $msg->admin_note }}
                                    </div>
                                @endif
                            </td>
                            <td style="font-size: 0.78rem; color: #9ca3af; white-space: nowrap;">
                                {{ $msg->created_at->format('d M Y, H:i') }}<br>
                                ({{ $msg->created_at->diffForHumans() }})
                            </td>
                            <td>
                                <div class="cms-action-btns">
                                    <button type="button" class="btn-cms-sm btn-cms-edit" onclick="openMsgModal({{ $msg->id }})" title="Lihat / Edit Pesan">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>

                                    @if($msg->telepon)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->telepon) }}?text=Halo%20{{ urlencode($msg->nama) }},%20saya%20Ibrahim%20menanggapi%20pesan%20Anda" 
                                           target="_blank" 
                                           class="btn-cms-sm btn-cms-check" 
                                           title="Balas via WhatsApp">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    @endif

                                    <form action="{{ route('cms.pesan.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cms-sm btn-cms-delete" title="Hapus Pesan">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Pesan Masuk -->
                        <div id="msg-modal-{{ $msg->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
                            <div style="background: #111827; border: 1px solid #374151; border-radius: 12px; width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; padding: 26px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <h3 style="color: #fff; font-size: 1.2rem;">Edit & Respon Pesan: {{ $msg->nama }}</h3>
                                    <button type="button" onclick="closeMsgModal({{ $msg->id }})" style="background: transparent; border: none; color: #9ca3af; font-size: 1.5rem; cursor: pointer;">&times;</button>
                                </div>
                                <form action="{{ route('cms.pesan.update', $msg->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="cms-form-grid">
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Nama Pengirim</label>
                                            <input type="text" name="nama" class="cms-input" value="{{ $msg->nama }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Email</label>
                                            <input type="email" name="email" class="cms-input" value="{{ $msg->email }}" required>
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">No. Telepon / WA</label>
                                            <input type="text" name="telepon" class="cms-input" value="{{ $msg->telepon }}">
                                        </div>
                                        <div class="cms-form-group">
                                            <label class="cms-form-label">Layanan Diminati</label>
                                            <input type="text" name="layanan" class="cms-input" value="{{ $msg->layanan }}">
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label">Isi Pesan Masuk</label>
                                            <textarea name="pesan" rows="3" class="cms-textarea" required>{{ $msg->pesan }}</textarea>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label class="cms-form-label" style="color: #fbbf24;"><i class="fa-solid fa-note-sticky"></i> Catatan Internal Pemilik (Admin Note)</label>
                                            <textarea name="admin_note" rows="2" class="cms-textarea" placeholder="Contoh: Sudah follow up via WA tanggal 6 Nov, penawaran disetujui...">{{ $msg->admin_note }}</textarea>
                                        </div>
                                        <div class="cms-form-group full">
                                            <label style="color: #cbd5e1; cursor: pointer;">
                                                <input type="checkbox" name="is_read" value="1" {{ $msg->is_read ? 'checked' : '' }}> Tandai sebagai Sudah Dibaca
                                            </label>
                                        </div>
                                    </div>
                                    <div style="margin-top: 18px; display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" onclick="closeMsgModal({{ $msg->id }})" class="btn-cms-sm btn-cms-delete">Batal</button>
                                        <button type="submit" class="btn-cms-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: #6b7280; padding: 30px;">Belum ada pesan yang masuk dari pengunjung.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $messages->links() }}
        </div>
    </div>

    <script>
        function openMsgModal(id) {
            document.getElementById('msg-modal-' + id).style.display = 'flex';
        }
        function closeMsgModal(id) {
            document.getElementById('msg-modal-' + id).style.display = 'none';
        }
    </script>
@endsection
