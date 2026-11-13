<?php

namespace Database\Seeders;

use App\Models\BannerSlide;
use App\Models\Certification;
use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\ProfileSetting;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ProfileSetting::query()->firstOrCreate([], [
            'name' => 'Ibrahim',
            'title' => 'Senior Fullstack Web Developer & Tech Lead',
            'status_text' => 'Tersedia untuk Jasa & Training',
            'bio_summary' => 'Membangun solusi digital modern, aman, responsif, dan mudah dikelola.',
            'email' => 'ibrahim@portfolio.com',
            'phone' => '+62 812-3456-7890',
            'whatsapp_number' => '6281234567890',
            'location' => 'Jakarta & Bandung, Indonesia',
            'working_hours' => 'Senin - Sabtu (08:00 - 21:00 WIB)',
            'footer_about' => 'Pengembang web profesional dan instruktur teknologi yang berfokus menciptakan solusi aplikasi modern dan mudah dikelola.',
        ]);
        if (BannerSlide::count() === 0) {
            BannerSlide::create([
                'badge_text' => 'Full Stack Web Developer & Trainer',
                'title' => 'Membangun solusi digital dengan',
                'highlight_text' => 'kode berkualitas dan performa tinggi',
                'description' => 'Pengembang web profesional dan mentor pemrograman yang membantu bisnis bertransformasi.',
                'button1_text' => 'Lihat CV Lengkap',
                'button1_url' => '#cv-section',
                'button2_text' => 'Dokumentasi Proyek',
                'button2_url' => '#dokumentasi-section',
                'mockup_title' => 'Arsitektur Modern',
                'mockup_desc' => 'Laravel, REST API, dan clean code.',
                'mockup_stat1_val' => '120+',
                'mockup_stat1_label' => 'Proyek selesai',
                'mockup_stat2_val' => '500+',
                'mockup_stat2_label' => 'Peserta training',
            ]);
        }
        // 1. Akun Pemilik CMS (Admin)
        User::updateOrCreate(
            ['email' => 'ibrahim@portfolio.com'],
            [
                'name' => 'Ibrahim (Pemilik Web & CMS)',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. ProfileSetting (Pengaturan Profil, Kontak, Maps, Medsos, Footer)
        ProfileSetting::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Ibrahim',
                'title' => 'Senior Fullstack Web Developer & Tech Lead',
                'status_text' => 'Tersedia untuk Jasa & Training',
                'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300&auto=format&fit=crop&q=80',
                'cv_download_url' => 'https://wa.me/6281234567890?text=Halo%20Mas%20Ibrahim,%20mohon%20kirimkan%20file%20CV%20PDF%20lengkap',
                'bio_summary' => 'Pengembang web profesional dan mentor pemrograman dengan pengalaman 7+ tahun membantu bisnis bertransformasi serta mencetak developer handal siap industri.',
                'email' => 'ibrahim@portfolio.com',
                'phone' => '+62 812-3456-7890',
                'whatsapp_number' => '6281234567890',
                'location' => 'Jakarta & Bandung, Indonesia',
                'working_hours' => 'Senin - Sabtu (08:00 - 21:00 WIB)',
                'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126930.2223456789!2d106.789123!3d-6.208763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%20Pusat%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
                'stat_years_exp' => '7+ Tahun',
                'stat_projects_done' => '120+',
                'stat_students_trained' => '500+',
                'stat_client_satisfaction' => '99.8%',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'instagram_url' => 'https://instagram.com',
                'youtube_url' => 'https://youtube.com',
                'twitter_url' => 'https://twitter.com',
                'footer_about' => 'Pengembang web profesional dan instruktur teknologi yang berfokus menciptakan solusi aplikasi modern, aman, responsif, dan mudah dikelola.',
                'copyright_text' => 'Ibrahim Digital Portfolio. Hak Cipta Dilindungi Undang-Undang.',
            ]
        );

        // 3. Banner Slides (Slide Banner Carousel)
        $slides = [
            [
                'badge_text' => 'Full Stack Web Developer & Trainer',
                'title' => 'Membangun Solusi Digital dengan',
                'highlight_text' => 'Kode Berkualitas & Performa Tinggi',
                'description' => 'Halo! Saya Ibrahim, pengembang web profesional dan mentor pemrograman dengan pengalaman 7+ tahun membantu bisnis bertransformasi serta mencetak developer handal siap industri.',
                'button1_text' => 'Lihat CV Lengkap',
                'button1_url' => '#cv-section',
                'button2_text' => 'Dokumentasi Proyek',
                'button2_url' => '#dokumentasi-section',
                'mockup_icon' => 'fa-solid fa-laptop-code',
                'mockup_title' => 'Arsitektur Modern',
                'mockup_desc' => 'Laravel 12, REST API, Tailwind CSS & Clean Code.',
                'mockup_stat1_val' => '120+',
                'mockup_stat1_label' => 'Proyek Selesai',
                'mockup_stat2_val' => '500+',
                'mockup_stat2_label' => 'Siswa Training',
                'bg_gradient' => 'slide-bg-1',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'badge_text' => 'Solusi Digital Bisnis',
                'title' => 'Jasa Pembuatan Website',
                'highlight_text' => 'Elegan, Cepat & Bergaransi',
                'description' => 'Tingkatkan omset dan kepercayaan klien Anda. Pembuatan website company profile, landing page berkonversi tinggi, toko online, hingga sistem informasi web kustom sesuai alur bisnis Anda.',
                'button1_text' => 'Paket & Harga Layanan',
                'button1_url' => '#layanan-section',
                'button2_text' => 'Konsultasi Gratis',
                'button2_url' => 'https://wa.me/6281234567890?text=Halo%20Mas%20Ibrahim,%20saya%20tertarik%20dengan%20jasa%20website',
                'mockup_icon' => 'fa-solid fa-rocket',
                'mockup_title' => 'Kecepatan & Konversi',
                'mockup_desc' => 'PageSpeed Score 95+, Mobile Responsive, dan SEO Terpadu.',
                'mockup_stat1_val' => '100%',
                'mockup_stat1_label' => 'Mobile Friendly',
                'mockup_stat2_val' => '3 Bulan',
                'mockup_stat2_label' => 'Garansi Gratis',
                'bg_gradient' => 'slide-bg-2',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'badge_text' => 'Akademi & Mentoring',
                'title' => 'Training Pemrograman Web',
                'highlight_text' => 'Dari Dasar Sampai Siap Kerja',
                'description' => 'Belajar langsung studi kasus nyata dunia industri: Logika pemrograman, arsitektur Laravel, REST API, autentikasi aman, hingga deploy ke server cloud. Bimbingan privat 1-on-1 maupun kelas corporate.',
                'button1_text' => 'Lihat Program Belajar',
                'button1_url' => '#layanan-section',
                'button2_text' => 'Tonton Cuplikan Video',
                'button2_url' => '#video-section',
                'mockup_icon' => 'fa-solid fa-user-graduate',
                'mockup_title' => 'Kurikulum Terarah',
                'mockup_desc' => 'Materi berbasis proyek riil dengan review kode personal.',
                'mockup_stat1_val' => '50+ Jam',
                'mockup_stat1_label' => 'Materi Video',
                'mockup_stat2_val' => 'Resmi',
                'mockup_stat2_label' => 'Sertifikat Belajar',
                'bg_gradient' => 'slide-bg-3',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($slides as $slide) {
            BannerSlide::updateOrCreate(['title' => $slide['title']], $slide);
        }

        // 4. Experience (Pengalaman Kerja)
        $experiences = [
            [
                'period' => '2023 - Sekarang',
                'role' => 'Lead Web Architect & IT Trainer',
                'company' => 'IndoTech Solusindo & Freelance Agency',
                'description' => 'Merancang arsitektur sistem informasi web skala enterprise, memimpin tim 6 developer, dan mengadakan pelatihan corporate Laravel serta RESTful API untuk klien instansi dan korporat.',
                'sort_order' => 1,
            ],
            [
                'period' => '2020 - 2023',
                'role' => 'Senior Full Stack Web Developer',
                'company' => 'Nusa Digital Platform',
                'description' => 'Mengembangkan aplikasi SaaS B2B, portal e-commerce multi-vendor, integrasi payment gateway (Midtrans, Xendit), integrasi logistik, dan mengoptimalkan query database untuk menangani ribuan transaksi per menit.',
                'sort_order' => 2,
            ],
            [
                'period' => '2018 - 2020',
                'role' => 'Backend Developer & Laravel Specialist',
                'company' => 'Cyber Creative Labs',
                'description' => 'Membangun sistem CMS kustom, sistem reservasi hotel, integrasi WhatsApp API, dan modul keamanan data web untuk 40+ klien nasional.',
                'sort_order' => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(['role' => $exp['role'], 'company' => $exp['company']], $exp);
        }

        // 5. Skill (Keahlian Teknis)
        $skills = [
            ['name' => 'PHP & Laravel Ecosystem', 'percentage' => 98, 'category' => 'Core Stack', 'icon' => 'fa-brands fa-laravel', 'sort_order' => 1],
            ['name' => 'JavaScript, Vue.js & Tailwind CSS', 'percentage' => 92, 'category' => 'Core Stack', 'icon' => 'fa-brands fa-vuejs', 'sort_order' => 2],
            ['name' => 'Database (MySQL, PostgreSQL, Redis)', 'percentage' => 94, 'category' => 'Core Stack', 'icon' => 'fa-solid fa-database', 'sort_order' => 3],
            ['name' => 'REST API & Payment Gateway Integration', 'percentage' => 96, 'category' => 'Core Stack', 'icon' => 'fa-solid fa-network-wired', 'sort_order' => 4],
            ['name' => 'Linux Server, Docker & Git CI/CD', 'percentage' => 88, 'category' => 'Core Stack', 'icon' => 'fa-brands fa-docker', 'sort_order' => 5],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }

        // 6. Certification & Pendidikan
        $certifications = [
            ['title' => 'Certified Laravel Expert Developer', 'issuer' => 'Laravel Certification Authority', 'year' => '2023', 'icon' => 'fa-solid fa-award', 'icon_color' => '#f59e0b', 'sort_order' => 1],
            ['title' => 'Web Security & OWASP Top 10 Specialist', 'issuer' => 'Cyber Security Institute', 'year' => '2024', 'icon' => 'fa-solid fa-shield-halved', 'icon_color' => '#10b981', 'sort_order' => 2],
            ['title' => 'Certified Professional Technical Trainer', 'issuer' => 'BNSP Republik Indonesia', 'year' => '2022', 'icon' => 'fa-solid fa-chalkboard-user', 'icon_color' => '#0284c7', 'sort_order' => 3],
        ];

        foreach ($certifications as $cert) {
            Certification::updateOrCreate(['title' => $cert['title']], $cert);
        }

        // 6b. Pendidikan Formal
        Education::updateOrCreate(
            ['degree' => 'Sarjana Komputer (S.Kom) - Teknik Informatika'],
            [
                'institution' => 'Universitas Indonesia / Institut Teknologi',
                'year_graduated' => 'Lulus Predikat Cumlaude • 2020',
                'icon' => 'fa-solid fa-university',
                'sort_order' => 1,
            ]
        );

        // 7. Layanan (Jasa Website & Training)
        $services = [
            [
                'title' => 'Website Company Profile Korporat',
                'category' => 'website',
                'icon' => 'fa-solid fa-building',
                'badge' => 'Populer',
                'short_desc' => 'Tingkatkan kredibilitas bisnis Anda dengan website profil perusahaan yang elegan, responsif, dan SEO friendly.',
                'description' => 'Solusi tepat untuk perusahaan, instansi, atau bisnis UKM yang ingin tampil terpercaya di mata klien. Dilengkapi integrasi WhatsApp, formulir kontak dinamis, company bio, galeri produk, sertifikat SSL gratis, dan optimasi kecepatan Google PageSpeed 90+.',
                'price' => 'Mulai Rp 1.800.000',
                'features' => [
                    'Desain Elegan, Modern & Mobile Responsive',
                    'Integrasi Google Maps & Tombol WhatsApp',
                    'Optimasi SEO Basic (Muncul di Pencarian Google)',
                    'Domain .com & Hosting SSD 1 Tahun',
                    'Akses CMS Mudah Kelola Konten & Halaman',
                    'Garansi & Maintenance Gratis 3 Bulan',
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Toko Online & E-Commerce Pro',
                'category' => 'website',
                'icon' => 'fa-solid fa-cart-shopping',
                'badge' => 'Best Value',
                'short_desc' => 'Platform e-commerce lengkap dengan manajemen produk, kalkulasi ongkir otomatis (RajaOngkir), dan payment gateway terintegrasi.',
                'description' => 'Toko online kustom yang siap jualan 24/7. Mendukung integrasi payment gateway Midtrans/Xendit (QRIS, VA Bank, E-Wallet), notifikasi pesanan via WhatsApp/Email, manajemen stok real-time, dan dashboard laporan penjualan.',
                'price' => 'Mulai Rp 3.500.000',
                'features' => [
                    'Integrasi Pembayaran Otomatis (QRIS, VA, E-Wallet)',
                    'Cek Ongkir Otomatis JNE, J&T, SiCepat, dll.',
                    'Manajemen Stok & Diskon Promo Kupon',
                    'Notifikasi Otomatis WhatsApp ke Pembeli & Penjual',
                    'Dashboard Analitik Penjualan & Laporan Keuangan',
                    'Dukungan Multi-Admin & Hak Akses',
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Aplikasi Web Kustom & Sistem Informasi',
                'category' => 'website',
                'icon' => 'fa-solid fa-laptop-code',
                'badge' => 'Custom',
                'short_desc' => 'Membangun sistem informasi operasional (ERP, CRM, POS Kasir, SIAKAD, HRIS) sesuai alur kerja spesifik perusahaan Anda.',
                'description' => 'Aplikasi web skala enterprise berbasis framework Laravel terbaru. Arsitektur modular, keamanan data terjamin, role & permission bertingkat, ekspor PDF/Excel instan, dan performa tinggi tanpa lemot.',
                'price' => 'Konsultasi Kebutuhan',
                'features' => [
                    'Arsitektur Laravel 12 & Database Terstruktur',
                    'Sistem Role & Multi-Level Permission Pengguna',
                    'Ekspor Laporan PDF & Excel Sekali Klik',
                    'Integrasi REST API & Webhook Pihak Ketiga',
                    'Audit Log & Keamanan Data Enkripsi Ketat',
                    'Pendampingan Migrasi Data & Training User',
                ],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Training Fullstack Laravel dari Nol',
                'category' => 'training',
                'icon' => 'fa-solid fa-graduation-cap',
                'badge' => 'Best Seller',
                'short_desc' => 'Program intensif belajar Laravel dari fundamental logika PHP hingga merilis aplikasi web database kompleks siap portofolio.',
                'description' => 'Cocok untuk mahasiswa, fresh graduate, atau pemula yang ingin loncat karir menjadi Web Developer. Materi berbasis studi kasus riil dunia kerja, bukan hanya teori.',
                'price' => 'Rp 950.000 / Peserta',
                'features' => [
                    'Kurikulum Terarah (PHP OOP, MVC, Blade, Eloquent, Migration)',
                    'Studi Kasus Nyata: Bikin Toko Online & Aplikasi Kasir',
                    'Mentoring Interaktif Live Coding & Review Kode',
                    'Source Code Lengkap & Rekaman Materi Selamanya',
                    'Sertifikat Kelulusan Resmi untuk Melamar Kerja',
                    'Grup Diskusi & Konsultasi Karir Seumur Hidup',
                ],
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Mentoring Privat 1-on-1 (Eksklusif)',
                'category' => 'training',
                'icon' => 'fa-solid fa-chalkboard-user',
                'badge' => 'VIP',
                'short_desc' => 'Bimbingan tatap muka online intensif satu-satu dengan kurikulum fleksibel disesuaikan dengan target atau skripsi/tugas akhir Anda.',
                'description' => 'Dapatkan pendampingan langsung tanpa distraksi. Bebas konsultasi error, pembuatan arsitektur proyek, review algoritma, persiapan technical interview kerja, maupun pengerjaan skripsi/thesis.',
                'price' => 'Rp 1.500.000 / Bulan',
                'features' => [
                    'Jadwal Fleksibel (Weekend / Malam Hari Bebas Pilih)',
                    'Kurikulum Disesuaikan Target Pribadi & Tugas Proyek',
                    'Debugging Langsung Error Proyek Milik Anda',
                    'Bedah Best Practice Clean Code & Security Vulnerabilities',
                    'Review CV Tech & Simulasi Wawancara Kerja Programmer',
                    'Dukungan Chat WhatsApp Prioritas Tanpa Batas',
                ],
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Corporate IT Training untuk Tim Kantor',
                'category' => 'training',
                'icon' => 'fa-solid fa-users-gear',
                'badge' => 'In-House',
                'short_desc' => 'Pelatihan peningkatan skill teknologi web untuk divisi IT atau karyawan perusahaan guna mempercepat proses digitalisasi internal.',
                'description' => 'Program pelatihan in-house (online / offline) untuk korporasi, BUMN, dan startup yang ingin menstandardisasi kemampuan tim developer menggunakan ekosistem modern Laravel, Git Flow, API Development, dan CI/CD Deployment.',
                'price' => 'Sesuai Ukuran Tim',
                'features' => [
                    'Modul Khusus Sesuai Tech Stack & Kebutuhan Kantor',
                    'Metodologi Agile & Best Practice Git Collaboration',
                    'Rest API Architecture & Security Penetration Testing',
                    'Post-Training Evaluation & Laporan Kemajuan Karyawan',
                    'Sertifikasi & Modul Dokumentasi Teknis Lengkap',
                    'Garansi Sesi Tanya Jawab Lanjutan Selama 1 Bulan',
                ],
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }

        // 8. Card Dokumentasi Proyek (Projects)
        $projects = [
            [
                'title' => 'Sistem Informasi Manajemen Rumah Sakit & Rekam Medis (SIMRS)',
                'category' => 'Sistem Informasi Web',
                'client' => 'RSUD Bhakti Sehat',
                'image_url' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&auto=format&fit=crop&q=80',
                'description' => 'Dokumentasi implementasi aplikasi SIMRS berbasis Laravel dengan modul pendaftaran pasien online, antrean poliklinik terintegrasi display monitor suara, rekam medis elektronik (RME) standar Kemenkes SATUSEHAT, modul apotek & farmasi, serta tagihan billing kasir terintegrasi asuransi BPJS.',
                'tech_stack' => 'Laravel 11, PostgreSQL, Tailwind CSS, WebSockets, SATUSEHAT API',
                'demo_url' => 'https://simrs-demo.example.com',
                'github_url' => 'https://github.com/ibrahim/simrs-core',
                'sort_order' => 1,
            ],
            [
                'title' => 'Marketplace B2B Distribusi Bahan Bangunan & Toko Material',
                'category' => 'E-Commerce Platform',
                'client' => 'PT Mitra Niaga Bangunan',
                'image_url' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&auto=format&fit=crop&q=80',
                'description' => 'Dokumentasi platform pemesanan dan distribusi logistik B2B untuk supplier dan 150+ toko material di Jabodetabek. Menangani pesanan grosir berton-ton, sistem kredit tempo (TOP), kalkulasi armada truk, surat jalan digital ber-barcode, dan sinkronisasi stok otomatis antar gudang.',
                'tech_stack' => 'Laravel 12, Livewire, Alpine.js, MySQL, Redis, Midtrans VA',
                'demo_url' => 'https://b2b-bangunan.example.com',
                'github_url' => 'https://github.com/ibrahim/b2b-material-dist',
                'sort_order' => 2,
            ],
            [
                'title' => 'Portal Company Profile & Booking Hotel Resort Luxury Bali',
                'category' => 'Company Profile & Booking',
                'client' => 'Samudera Bliss Resort & Spa',
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&auto=format&fit=crop&q=80',
                'description' => 'Dokumentasi website profil resor mewah bintang 5 dengan visual interaktif 360-derajat, kalender ketersediaan kamar real-time, reservasi spa eksklusif, multi-bahasa (Inggris, Mandarin, Indonesia), dan integrasi sistem pembayaran internasional Stripe & PayPal.',
                'tech_stack' => 'Laravel, Blade Engine, Vanilla JS, CSS3 Parallax, Stripe API',
                'demo_url' => 'https://resort-bali-demo.example.com',
                'github_url' => 'https://github.com/ibrahim/resort-luxury-portal',
                'sort_order' => 3,
            ],
            [
                'title' => 'Aplikasi POS Kasir & Laporan Omset Realtime (KasirKu Multi-Cabang)',
                'category' => 'Point of Sales (POS)',
                'client' => 'Jaringan Kafe Kopi Seduh Kita (8 Cabang)',
                'image_url' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800&auto=format&fit=crop&q=80',
                'description' => 'Dokumentasi aplikasi kasir cloud-based yang dapat beroperasi offline maupun online. Fitur split bill, cetak struk thermal via Bluetooth printer, cetak label barcode pesanan barista, integrasi QRIS dinamis, dan dashboard owner untuk memantau laba kotor tiap detik.',
                'tech_stack' => 'Laravel REST API, PWA (Progressive Web App), Vue.js, Tailwind CSS',
                'demo_url' => 'https://kasirku-demo.example.com',
                'github_url' => 'https://github.com/ibrahim/pos-kasirku-app',
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $proj) {
            Project::updateOrCreate(['title' => $proj['title']], $proj);
        }

        // 9. Card Video Showcase (Videos)
        $videos = [
            [
                'title' => 'Demo Proyek: Walkthrough Sistem POS KasirKu Multi-Cabang & Fitur QRIS Otomatis',
                'category' => 'Demo Proyek',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1556742049-0a67e557224d?w=800&auto=format&fit=crop&q=80',
                'duration' => '14:20',
                'description' => 'Video bedah fitur aplikasi kasir berbasis web: alur transaksi cepat di kasir, sinkronisasi pesanan ke dapur (KDS), cetak struk Bluetooth thermal, dan laporan omset harian otomatis masuk ke email pemilik.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Tutorial & Live Coding: Membangun Autentikasi Modern Multi-Role di Laravel 12',
                'category' => 'Tutorial Pemrograman',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&auto=format&fit=crop&q=80',
                'duration' => '25:45',
                'description' => 'Rekaman sesi materi training pemrograman: langkah demi langkah membuat sistem login, register, proteksi route middleware, session timeout, hingga manajemen hak akses Admin dan Pengguna Biasa.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Showcase: Desain Website Responsif & Animasi Interaktif Tanpa Framework Berat',
                'category' => 'Web Design & Tips',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=800&auto=format&fit=crop&q=80',
                'duration' => '18:10',
                'description' => 'Pembahasan tips UI/UX untuk meningkatkan konversi penjualan website: prinsip visual hierarchy, tipografi ramah mata, efek hover mikro interaksi, dan optimasi aset agar loading di bawah 1 detik.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Webinar IT: Roadmap Karir Menjadi Fullstack Web Developer Profesional di 2026',
                'category' => 'Webinar & Mentoring',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800&auto=format&fit=crop&q=80',
                'duration' => '42:30',
                'description' => 'Sesi sharing pengalaman 7+ tahun di industri teknologi: bagaimana cara menyusun portofolio yang dilirik klien & recruiter, strategi memenangkan tender website, serta tips belajar coding yang efektif.',
                'sort_order' => 4,
            ],
        ];

        foreach ($videos as $vid) {
            Video::updateOrCreate(['title' => $vid['title']], $vid);
        }

        // 10. Apa Kata Mereka (Testimonials)
        $testimonials = [
            [
                'name' => 'Hendro Wijaya, S.Kom.',
                'role' => 'Direktur Operasional',
                'company' => 'PT Surya Mega Logistik',
                'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&auto=format&fit=crop&q=80',
                'content' => 'Mas Ibrahim sangat profesional dalam mengeksekusi sistem logistik perusahaan kami. Tampilan website sangat rapi, loading sangat cepat, dan instruksi serah terimanya jelas. Sangat direkomendasikan bagi siapapun yang butuh web berkualitas tinggi!',
                'rating' => 5,
                'sort_order' => 1,
            ],
            [
                'name' => 'dr. Anita Larasati',
                'role' => 'Founder & Owner',
                'company' => 'Aura Skin Clinic Jakarta',
                'avatar_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&auto=format&fit=crop&q=80',
                'content' => 'Website klinik kecantikan kami dibuat oleh Mas Ibrahim. Pasien sangat terbantu dengan fitur booking konsultasi online dan tampilan yang sangat elegan. Omset konsultasi online kami naik hampir 70% setelah website baru ini live!',
                'rating' => 5,
                'sort_order' => 2,
            ],
            [
                'name' => 'Fajar Pratama',
                'role' => 'Junior Web Developer (Alumni Training)',
                'company' => 'PT Telkom Digital Solusi',
                'avatar_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&auto=format&fit=crop&q=80',
                'content' => 'Saya ikut kelas training privat Laravel bersama Kak Ibrahim dari nol banget. Penjelasannya sangat runut, santai, dan langsung praktek studi kasus proyek nyata. Berkat portofolio dari kelas ini, alhamdulillah saya langsung diterima kerja!',
                'rating' => 5,
                'sort_order' => 3,
            ],
            [
                'name' => 'Rian Kurniawan',
                'role' => 'Head of Marketing',
                'company' => 'Griya Furniture Jepara',
                'avatar_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&auto=format&fit=crop&q=80',
                'content' => 'Pelayanan pembuatan website dari Mas Ibrahim melebihi ekspektasi kami. Revisi ditanggapi ramah, integrasi payment gateway lancar, dan diajari cara memakai dashboard CMS-nya sampai paham. Mantap pol!',
                'rating' => 5,
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $testi) {
            Testimonial::updateOrCreate(['name' => $testi['name']], $testi);
        }

        // 11. Pesan Kontak Awal
        $messages = [
            [
                'nama' => 'Bambang Sudirjo',
                'email' => 'bambang.s@perusahaanmitra.co.id',
                'telepon' => '081234567890',
                'layanan' => 'Jasa Pembuatan Website',
                'pesan' => 'Halo Mas Ibrahim, kami tertarik untuk membuat sistem company profile dan katalog produk interaktif untuk perusahaan ekspor mebel kami. Bisa tolong kirimkan proposal dan estimasi waktunya?',
                'is_read' => false,
            ],
            [
                'nama' => 'Rina Salsabila',
                'email' => 'rina.salsa@gmail.com',
                'telepon' => '085712345678',
                'layanan' => 'Training Pemrograman',
                'pesan' => 'Selamat siang, saya mau tanya pendaftaran training privat Laravel 1-on-1 apakah masih ada slot untuk bulan depan? Terima kasih.',
                'is_read' => true,
            ],
        ];

        foreach ($messages as $msg) {
            ContactMessage::updateOrCreate(['email' => $msg['email']], $msg);
        }
    }
}
