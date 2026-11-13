<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\PortofolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Publik Web Portofolio CV & Jasa
|--------------------------------------------------------------------------
*/
Route::get('/', [PortofolioController::class, 'index'])->name('home');
Route::get('/cv', [PortofolioController::class, 'cv'])->name('cv');
Route::get('/layanan', [PortofolioController::class, 'layanan'])->name('layanan');
Route::get('/dokumentasi', [PortofolioController::class, 'dokumentasi'])->name('dokumentasi');
Route::get('/video', [PortofolioController::class, 'video'])->name('video');
Route::get('/testimoni', [PortofolioController::class, 'testimoni'])->name('testimoni');
Route::get('/kontak', [PortofolioController::class, 'kontak'])->name('kontak');
Route::post('/kirim-pesan', [PortofolioController::class, 'kirimPesan'])->name('kirim.pesan');

/*
|--------------------------------------------------------------------------
| Autentikasi Pemilik Web (Login / Logout CMS)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| CMS (Control Management System) Pemilik Portofolio
| Diproteksi oleh middleware auth
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('cms')->name('cms.')->group(function () {
    Route::get('/', [CmsController::class, 'dashboard'])->name('dashboard');

    // 1. Akun Pengguna (Ubah Email & Password)
    Route::get('/akun', [CmsController::class, 'akun'])->name('akun');
    Route::post('/akun', [CmsController::class, 'updateAkun'])->name('akun.update');

    // 2. Pengaturan Profil, Foto Avatar, Kontak, Maps, Medsos, Footer
    Route::get('/pengaturan', [CmsController::class, 'pengaturan'])->name('pengaturan');
    Route::post('/pengaturan', [CmsController::class, 'updatePengaturan'])->name('pengaturan.update');

    // 3. Kelola Slide Banner Carousel
    Route::get('/banner', [CmsController::class, 'banner'])->name('banner');
    Route::post('/banner', [CmsController::class, 'storeBanner'])->name('banner.store');
    Route::put('/banner/{id}', [CmsController::class, 'updateBanner'])->name('banner.update');
    Route::delete('/banner/{id}', [CmsController::class, 'destroyBanner'])->name('banner.destroy');

    // 4. Kelola Konten CV Digital (Pengalaman, Skill, Sertifikasi, Pendidikan)
    Route::get('/cv', [CmsController::class, 'cv'])->name('cv');
    Route::post('/cv/pengalaman', [CmsController::class, 'storePengalaman'])->name('pengalaman.store');
    Route::put('/cv/pengalaman/{id}', [CmsController::class, 'updatePengalaman'])->name('pengalaman.update');
    Route::delete('/cv/pengalaman/{id}', [CmsController::class, 'destroyPengalaman'])->name('pengalaman.destroy');

    Route::post('/cv/skill', [CmsController::class, 'storeSkill'])->name('skill.store');
    Route::put('/cv/skill/{id}', [CmsController::class, 'updateSkill'])->name('skill.update');
    Route::delete('/cv/skill/{id}', [CmsController::class, 'destroySkill'])->name('skill.destroy');

    Route::post('/cv/sertifikasi', [CmsController::class, 'storeSertifikasi'])->name('sertifikasi.store');
    Route::put('/cv/sertifikasi/{id}', [CmsController::class, 'updateSertifikasi'])->name('sertifikasi.update');
    Route::delete('/cv/sertifikasi/{id}', [CmsController::class, 'destroySertifikasi'])->name('sertifikasi.destroy');

    Route::post('/cv/pendidikan', [CmsController::class, 'storePendidikan'])->name('pendidikan.store');
    Route::put('/cv/pendidikan/{id}', [CmsController::class, 'updatePendidikan'])->name('pendidikan.update');
    Route::delete('/cv/pendidikan/{id}', [CmsController::class, 'destroyPendidikan'])->name('pendidikan.destroy');

    // 5. Kelola Layanan (Website & Training)
    Route::get('/layanan', [CmsController::class, 'layanan'])->name('layanan');
    Route::post('/layanan', [CmsController::class, 'storeLayanan'])->name('layanan.store');
    Route::put('/layanan/{id}', [CmsController::class, 'updateLayanan'])->name('layanan.update');
    Route::delete('/layanan/{id}', [CmsController::class, 'destroyLayanan'])->name('layanan.destroy');

    // 6. Kelola Card Dokumentasi Proyek
    Route::get('/proyek', [CmsController::class, 'proyek'])->name('proyek');
    Route::post('/proyek', [CmsController::class, 'storeProyek'])->name('proyek.store');
    Route::put('/proyek/{id}', [CmsController::class, 'updateProyek'])->name('proyek.update');
    Route::delete('/proyek/{id}', [CmsController::class, 'destroyProyek'])->name('proyek.destroy');

    // 7. Kelola Card Video Showcase
    Route::get('/video', [CmsController::class, 'video'])->name('video');
    Route::post('/video', [CmsController::class, 'storeVideo'])->name('video.store');
    Route::put('/video/{id}', [CmsController::class, 'updateVideo'])->name('video.update');
    Route::delete('/video/{id}', [CmsController::class, 'destroyVideo'])->name('video.destroy');

    // 8. Kelola Apa Kata Mereka (Testimoni)
    Route::get('/testimoni', [CmsController::class, 'testimoni'])->name('testimoni');
    Route::post('/testimoni', [CmsController::class, 'storeTestimoni'])->name('testimoni.store');
    Route::put('/testimoni/{id}', [CmsController::class, 'updateTestimoni'])->name('testimoni.update');
    Route::delete('/testimoni/{id}', [CmsController::class, 'destroyTestimoni'])->name('testimoni.destroy');

    // 9. Kelola Pesan Kontak Masuk
    Route::get('/pesan', [CmsController::class, 'pesan'])->name('pesan');
    Route::post('/pesan/{id}/baca', [CmsController::class, 'tandaiPesanDibaca'])->name('pesan.baca');
    Route::put('/pesan/{id}', [CmsController::class, 'updatePesan'])->name('pesan.update');
    Route::delete('/pesan/{id}', [CmsController::class, 'destroyPesan'])->name('pesan.destroy');
});
