@extends('layouts.cms')

@section('title', 'Ubah Email & Password - CMS Portofolio')

@section('cms_content')
    <div class="cms-page-header">
        <div>
            <h1 class="cms-page-title">Akun & Keamanan Pemilik</h1>
            <p class="cms-page-desc">Kelola profil pengguna, ubah alamat email login, dan perbarui kata sandi sistem CMS Anda.</p>
        </div>
    </div>

    <div style="max-width: 750px;">
        <div class="cms-panel-card">
            <h2 class="cms-panel-title" style="margin-bottom: 20px;">
                <i class="fa-solid fa-user-shield" style="color: #60a5fa;"></i> Pengaturan Akun & Akses Login
            </h2>

            <form action="{{ route('cms.akun.update') }}" method="POST">
                @csrf

                <!-- Informasi Dasar Akun -->
                <div class="cms-form-group">
                    <label class="cms-form-label">Nama Pengguna *</label>
                    <input type="text" name="name" class="cms-input" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="cms-form-group">
                    <label class="cms-form-label">Alamat Email Login *</label>
                    <input type="email" name="email" class="cms-input" value="{{ old('email', $user->email) }}" required>
                    <small style="color: #9ca3af; font-size: 0.78rem; margin-top: 4px; display: block;">
                        Email ini digunakan saat masuk ke halaman login CMS.
                    </small>
                </div>

                <hr style="border: 0; border-top: 1px solid #1f2937; margin: 30px 0;">

                <h3 style="color: #ffffff; font-size: 1.1rem; margin-bottom: 6px;">
                    <i class="fa-solid fa-key" style="color: #fbbf24;"></i> Perbarui Kata Sandi
                </h3>
                <p style="color: #9ca3af; font-size: 0.82rem; margin-bottom: 20px;">
                    Kosongkan form kata sandi di bawah jika Anda hanya ingin memperbarui nama atau alamat email.
                </p>

                <!-- Kata Sandi Saat Ini -->
                <div class="cms-form-group">
                    <label class="cms-form-label">Kata Sandi Saat Ini</label>
                    <div style="position: relative; display: flex; align-items: center;">
                        <input type="password" id="current_password" name="current_password" class="cms-input" placeholder="Masukkan kata sandi lama Anda">
                        <button type="button" onclick="togglePassVisibility('current_password', 'eye-curr')" style="position: absolute; right: 12px; background: transparent; border: none; color: #9ca3af; cursor: pointer; padding: 4px;">
                            <i class="fa-solid fa-eye" id="eye-curr"></i>
                        </button>
                    </div>
                </div>

                <div class="cms-form-grid">
                    <!-- Kata Sandi Baru -->
                    <div class="cms-form-group">
                        <label class="cms-form-label">Kata Sandi Baru</label>
                        <div style="position: relative; display: flex; align-items: center;">
                            <input type="password" id="new_password" name="new_password" class="cms-input" placeholder="Minimal 6 karakter">
                            <button type="button" onclick="togglePassVisibility('new_password', 'eye-new')" style="position: absolute; right: 12px; background: transparent; border: none; color: #9ca3af; cursor: pointer; padding: 4px;">
                                <i class="fa-solid fa-eye" id="eye-new"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Konfirmasi Kata Sandi Baru -->
                    <div class="cms-form-group">
                        <label class="cms-form-label">Ulangi Kata Sandi Baru</label>
                        <div style="position: relative; display: flex; align-items: center;">
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="cms-input" placeholder="Ketik ulang kata sandi baru">
                            <button type="button" onclick="togglePassVisibility('new_password_confirmation', 'eye-conf')" style="position: absolute; right: 12px; background: transparent; border: none; color: #9ca3af; cursor: pointer; padding: 4px;">
                                <i class="fa-solid fa-eye" id="eye-conf"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 24px;">
                    <button type="submit" class="btn-cms-primary" style="padding: 12px 24px; font-size: 0.95rem;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Akun & Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection

