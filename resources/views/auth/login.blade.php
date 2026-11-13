<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pemilik - CMS Portofolio Ibrahim</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-body">

    <!-- Ambient glowing backgrounds -->
    <div class="auth-glow-blob-1"></div>
    <div class="auth-glow-blob-2"></div>

    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo-badge">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1 class="auth-title">Akses CMS Pemilik</h1>
            <p class="auth-subtitle">Masuk untuk mengelola portofolio, layanan, proyek, dan pesan.</p>
        </div>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.88rem;">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        @if(session('sukses'))
            <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.88rem;">
                <i class="fa-solid fa-circle-check"></i> {{ session('sukses') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="auth-form">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="auth-input-wrapper">
                    <i class="fa-solid fa-envelope auth-input-icon"></i>
                    <input type="email" id="email" name="email" class="auth-input" placeholder="ibrahim@portfolio.com" value="{{ old('email', 'ibrahim@portfolio.com') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="auth-input-wrapper">
                    <i class="fa-solid fa-lock auth-input-icon"></i>
                    <input type="password" id="password" name="password" class="auth-input" placeholder="••••••••" value="password123" required style="padding-right: 48px;">
                    <!-- Tombol Ikon Mata Password -->
                    <button type="button" id="toggle-password-btn" class="auth-eye-btn" aria-label="Tampilkan atau sembunyikan kata sandi">
                        <i class="fa-solid fa-eye" id="password-eye-icon"></i>
                    </button>
                </div>
            </div>

            <div class="auth-options">
                <label class="auth-checkbox-label">
                    <input type="checkbox" name="remember" value="1" checked>
                    <span>Ingat Sesi Saya</span>
                </label>
                <span style="color: #64748b; font-size: 0.8rem;">Akses Khusus Pemilik</span>
            </div>

            <button type="submit" class="btn-auth-submit">
                <i class="fa-solid fa-right-to-bracket"></i> Masuk ke CMS
            </button>
        </form>

        <!-- Kotak Bantuan Kredensial Demo -->
        <div class="auth-credentials-hint">
            <p><strong><i class="fa-solid fa-key"></i> Kredensial Default Pemilik:</strong></p>
            <p>Email: <strong>ibrahim@portfolio.com</strong></p>
            <p>Password: <strong>password123</strong></p>
        </div>

        <div class="auth-footer-back">
            <a href="{{ route('home') }}">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda Publik
            </a>
        </div>
    </div>

    <!-- Script Toggle Visibilitas Password -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggle-password-btn');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('password-eye-icon');

            if (toggleBtn && passwordInput && eyeIcon) {
                toggleBtn.addEventListener('click', function () {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>

</body>
</html>
