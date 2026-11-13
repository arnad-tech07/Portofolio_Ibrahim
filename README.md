# 🌟 Ibrahim Digital Portfolio & CMS Control System

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tests Passing](<https://img.shields.io/badge/Tests-18%20Passed%20(100%25)-success?style=for-the-badge&logo=phpunit&logoColor=white>)](https://phpunit.de)
[![Code Style: Pint](https://img.shields.io/badge/Code%20Style-Laravel%20Pint-0ea5e9?style=for-the-badge)](https://laravel.com/docs/pint)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg?style=for-the-badge)](LICENSE)

Aplikasi web digital CV portofolio publik modern sekaligus platform penawaran **Jasa Pembuatan Website** dan **Program Training IT Pemrograman**, yang dilengkapi dengan sistem **Control Management System (CMS)** pemilik untuk mengelola seluruh isi konten website, unggah berkas gambar beresolusi tinggi (hingga 20 MB), dan manajemen keamanan akun.

---

## 📚 Dokumen Resmi & E-Book (Tersedia dalam Format `.doc` dan `.md`)

Berikut dokumen lengkap yang telah disediakan di dalam repositori ini:

| Nama Dokumen                            |      Format      | Lokasi Berkas                                                                                                                                                                                                                                     | Deskripsi                                                                                                                                                                                                                    |
| :-------------------------------------- | :--------------: | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | :--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **CV & Portofolio Profesional Ibrahim** |  `.doc` (Word)   | [`CV_Portofolio_Ibrahim.doc`](CV_Portofolio_Ibrahim.doc) / [`public/downloads/CV_Portofolio_Ibrahim.doc`](public/downloads/CV_Portofolio_Ibrahim.doc)                                                                                             | Berkas CV lengkap siap cetak & kirim: identitas, ringkasan eksekutif, kompetensi teknis, pengalaman kerja 7+ tahun, pendidikan cumlaude, sertifikasi resmi, showcase 5 proyek besar, 6 paket layanan, dan 4 testimoni klien. |
| **E-Book Panduan Web Portofolio & CMS** |  `.doc` (Word)   | [`EBOOK_PANDUAN_WEB_PORTOFOLIO_DAN_CMS_IBRAHIM.doc`](EBOOK_PANDUAN_WEB_PORTOFOLIO_DAN_CMS_IBRAHIM.doc) / [`public/downloads/EBOOK_PANDUAN_WEB_PORTOFOLIO_DAN_CMS_IBRAHIM.doc`](public/downloads/EBOOK_PANDUAN_WEB_PORTOFOLIO_DAN_CMS_IBRAHIM.doc) | Buku panduan lengkap (10 Bab + Lampiran) dalam format Microsoft Word A4: arsitektur sistem, panduan pengoperasian CMS, file upload manager 20MB, panduan deployment production, keamanan OWASP, dan silabus training.        |
| **E-Book Panduan Web Portofolio & CMS** | `.md` (Markdown) | [`EBOOK_PANDUAN_WEB_PORTOFOLIO_DAN_CMS_IBRAHIM.md`](EBOOK_PANDUAN_WEB_PORTOFOLIO_DAN_CMS_IBRAHIM.md)                                                                                                                                              | Versi Markdown dari buku panduan untuk kemudahan membaca di GitHub atau editor teks.                                                                                                                                         |

---

## 🚀 Fitur Unggulan Sistem

### 1. Tampilan Publik (Front-End)

- **Arsitektur CSS Terpisah (Modular):** Setiap halaman/komponen memiliki file stylesheet mandiri di `public/css/` tanpa tercampur.
- **Header Tetap di Atas (Sticky Fixed Topbar):** Navigasi melayang dengan status ketersediaan (_Tersedia untuk Jasa & Training_), tombol WhatsApp, tombol download CV, dan tombol masuk CMS.
- **Sidebar Sebelah Kiri (Left Sidebar Navigation):** Navigasi bergaya dashboard aplikasi modern dengan profil, tautan cepat berikon, dan kartu statistik (7+ Tahun Pengalaman, 120+ Proyek, 500+ Siswa).
- **Slide Banner Carousel:** Carousel banner interaktif dengan 3 slide, gradient menawan, tombol CTA, dan mockup statistik.
- **Komponen CV & Profil Lengkap:** Menampilkan ringkasan bio, timeline pengalaman karir, progress bar skill teknis, kartu sertifikasi, dan kartu pendidikan.
- **Katalog Layanan Jasa & Training:** 6 paket terstruktur (Company Profile, E-Commerce, Web Kustom ERP/POS, Training Dasar, Mentoring Privat 1-on-1, dan Corporate IT Training).
- **Card Dokumentasi Proyek:** Kartu portofolio proyek dengan gambar beresolusi tinggi, filter kategori, badge teknologi, serta tautan demo live dan GitHub.
- **Card Video Showcase:** Showcase video tutorial pemrograman dan webinar IT dengan badge durasi dan pemutar video YouTube interaktif.
- **Baris "Apa Kata Mereka":** Ulasan testimoni klien dan siswa alumni dengan rating bintang emas.
- **Peta Google Maps & Formulir Kontak:** Integrasi peta interaktif lokasi kantor dan form pesan publik langsung ke database.
- **Footer Modern:** Hak cipta copyright dan tautan media sosial bercahaya (_glow effect_).

### 2. Panel Kendali Pemilik (CMS Control Panel)

- **Autentikasi Pemilik:** Login aman dengan fitur **ikon mata interaktif** untuk melihat kata sandi sebelum masuk.
- **Akun & Keamanan (`/cms/akun`):** Fitur ubah Nama Pemilik, ubah Alamat Email login, serta perbarui Password dengan validasi kata sandi saat ini.
- **Pengaturan Profil, Peta & Medsos (`/cms/pengaturan`):** Ubah biodata, nomor WA, embed Google Maps, link medsos, dan ganti foto profil via upload file.
- **Unggah Berkas Fisik (Bukan URL):** Seluruh form mendukung upload berkas gambar (`.jpg`, `.jpeg`, `.png`, `.svg`, `.webp`) hingga **20 MB**, serta dokumen CV hingga **25 MB**.
- **Kelola Konten CV (`/cms/cv`):** CRUD mandiri untuk Pengalaman Kerja, Keahlian Teknis (Skill), Sertifikasi & Lisensi, dan Pendidikan.
- **Kelola Slide Banner Carousel (`/cms/banner`):** Tambah, ubah judul/deskripsi/tombol, dan atur status aktif slide.
- **Kelola Layanan Web & Training (`/cms/layanan`):** Ubah paket jasa, harga, deskripsi, dan butir fitur layanan.
- **Kelola Dokumentasi Proyek (`/cms/proyek`):** Tambah portofolio proyek dengan upload tangkapan layar beresolusi tinggi.
- **Kelola Video Showcase (`/cms/video`):** Kelola URL embed, durasi, dan upload thumbnail video.
- **Kelola Testimoni Klien (`/cms/testimoni`):** Tambah ulasan klien, upload foto avatar, dan tentukan rating bintang 1–5.
- **Manajemen Pesan Masuk (`/cms/pesan`):** Lihat pesan masuk dari publik, perbarui status pesan (_Belum Dibaca_, _Sudah Dibaca_, _Dibalas_, _Diarsipkan_), dan beri **Catatan Internal Admin**.

---

## 🛠️ Stack Teknologi

- **Framework Backend:** Laravel 12.x
- **Bahasa Pemrograman:** PHP 8.4+
- **Database:** SQLite (Bawaan) / MySQL / PostgreSQL
- **Frontend Engine:** Blade Components & Partials
- **Styling:** Modular CSS Terpisah (`public/css/`)
- **Icon Pack:** FontAwesome 6.5.1
- **Tipografi:** Google Font _Plus Jakarta Sans_
- **Pengujian Otomatis:** PHPUnit 11 (18 Feature Tests)
- **Linter & Formatter:** Laravel Pint

---

## 📦 Panduan Instalasi & Menjalankan Aplikasi

### 1. Clone & Masuk ke Folder Proyek

```bash
git clone https://github.com/ibrahim/portofolio_ibrahim.git
cd portofolio_ibrahim
```

### 2. Pasang Dependensi

```bash
composer install
npm install
```

### 3. Konfigurasi Environment & Storage

```bash
cp .env.example .env
php artisan key:generate
php artisan storage:link
```

### 4. Migrasi Database & Seeding Data Awal

```bash
php artisan migrate:fresh --seed
```

### 5. Kompilasi Aset Frontend

```bash
npm run build
```

### 6. Jalankan Server Lokal

```bash
php artisan serve
```

Akses di browser Anda:

- **Halaman Web Publik:** `http://127.0.0.1:8000`
- **Halaman Login CMS:** `http://127.0.0.1:8000/login`

---

## 🔐 Kredensial Login Default Pemilik CMS

- **URL Login:** `http://localhost:8000/login`
- **Email:** `ibrahim@portfolio.com`
- **Password:** `password123`

_(Email dan password dapat diubah kapan saja di menu CMS: **Akun & Keamanan**)_

---

## 🧪 Pengujian Otomatis (Automated Testing)

Aplikasi telah dilengkapi pengujian fitur komprehensif menggunakan PHPUnit:

```bash
php artisan test
```

**Hasil Pengujian:**

```
PASS  Tests\Feature\PortofolioTest
✓ public home page is accessible with all partial sections
✓ public cv page is accessible
✓ public layanan page is accessible
✓ public dokumentasi page is accessible
✓ public video page is accessible
✓ public testimoni page is accessible
✓ public kontak page is accessible
✓ visitor can send contact message successfully

PASS  Tests\Feature\AuthTest
✓ login page is accessible
✓ user can login with correct credentials
✓ user cannot login with incorrect credentials
✓ user can logout successfully

PASS  Tests\Feature\CmsTest
✓ guest cannot access cms dashboard
✓ authenticated owner can access dashboard and pages
✓ owner can update profile settings and upload files
✓ owner can add and update banner slide
✓ owner can add and update service
✓ owner can create project with image upload
✓ owner can update message status and admin note
✓ owner can update email and password

Tests:    18 passed (80 assertions)
Duration: 1.92s
```

---

## 📁 Struktur CSS Modular Terpisah

```
public/css/
├── layout.css          # Header tetap atas, sidebar kiri, canvas dasar
├── carousel.css        # Slide banner animasi & mockup
├── cv.css              # Timeline karir, skill bar, sertifikasi, pendidikan
├── layanan.css         # Kartu paket jasa web & training
├── dokumentasi.css     # Kartu portofolio proyek
├── video.css           # Kartu showcase video YouTube
├── testimoni.css       # Baris testimoni "Apa Kata Mereka"
├── kontak_maps.css     # Form kontak interaktif & iframe Google Maps
├── footer.css          # Footer copyright & ikon medsos glow
├── auth.css            # Formulir login & toggle icon mata password
└── cms.css             # Seluruh panel kontrol CMS & form upload
```

---

## 📄 Hak Cipta & Lisensi

Dibuat dan dikembangkan oleh **Ibrahim, S.Kom.**  
© 2026 Ibrahim Digital Portfolio. Hak Cipta Dilindungi Undang-Undang.  
Aplikasi ini berlisensi [MIT License](LICENSE).
