<?php

namespace App\Http\Controllers;

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
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortofolioController extends Controller
{
    /**
     * Mengambil setting profile default jika belum ada.
     */
    private function getSetting(): ProfileSetting
    {
        return ProfileSetting::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Ibrahim',
                'title' => 'Senior Fullstack Web Developer & Tech Lead',
                'status_text' => 'Tersedia untuk Jasa & Training',
                'email' => 'ibrahim@portfolio.com',
                'phone' => '+62 812-3456-7890',
                'whatsapp_number' => '6281234567890',
                'location' => 'Jakarta & Bandung, Indonesia',
                'working_hours' => 'Senin - Sabtu (08:00 - 21:00 WIB)',
                'stat_years_exp' => '7+ Tahun',
                'stat_projects_done' => '120+',
                'stat_students_trained' => '500+',
                'stat_client_satisfaction' => '99.8%',
            ]
        );
    }

    /**
     * Menampilkan halaman beranda utama (menggabungkan seluruh partials dinamis dari database).
     */
    public function index(): View
    {
        $setting = $this->getSetting();
        $bannerSlides = BannerSlide::where('is_active', true)->orderBy('sort_order')->get();
        $experiences = Experience::orderBy('sort_order')->get();
        $skills = Skill::orderBy('sort_order')->get();
        $certifications = Certification::orderBy('sort_order')->get();
        $educations = Education::orderBy('sort_order')->get();

        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $websiteServices = $services->where('category', 'website');
        $trainingServices = $services->where('category', 'training');

        $projects = Project::orderBy('sort_order')->get();
        $videos = Video::orderBy('sort_order')->get();
        $testimonials = Testimonial::orderBy('sort_order')->get();

        return view('halaman_portofolio.beranda_utama', compact(
            'setting',
            'bannerSlides',
            'experiences',
            'skills',
            'certifications',
            'educations',
            'services',
            'websiteServices',
            'trainingServices',
            'projects',
            'videos',
            'testimonials'
        ));
    }

    /**
     * Halaman tersendiri untuk CV & Profil Digital Ibrahim.
     */
    public function cv(): View
    {
        $setting = $this->getSetting();
        $experiences = Experience::orderBy('sort_order')->get();
        $skills = Skill::orderBy('sort_order')->get();
        $certifications = Certification::orderBy('sort_order')->get();
        $educations = Education::orderBy('sort_order')->get();

        return view('halaman_portofolio.cv', compact('setting', 'experiences', 'skills', 'certifications', 'educations'));
    }

    /**
     * Halaman tersendiri untuk Jasa Website & Training Pemrograman.
     */
    public function layanan(): View
    {
        $setting = $this->getSetting();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $websiteServices = $services->where('category', 'website');
        $trainingServices = $services->where('category', 'training');

        return view('halaman_portofolio.layanan', compact('setting', 'services', 'websiteServices', 'trainingServices'));
    }

    /**
     * Halaman tersendiri untuk Galeri & Dokumentasi Proyek.
     */
    public function dokumentasi(): View
    {
        $setting = $this->getSetting();
        $projects = Project::orderBy('sort_order')->get();

        return view('halaman_portofolio.dokumentasi', compact('setting', 'projects'));
    }

    /**
     * Halaman tersendiri untuk Showcase Video & Tutorial.
     */
    public function video(): View
    {
        $setting = $this->getSetting();
        $videos = Video::orderBy('sort_order')->get();

        return view('halaman_portofolio.video', compact('setting', 'videos'));
    }

    /**
     * Halaman tersendiri untuk Apa Kata Mereka (Testimoni Klien & Alumni).
     */
    public function testimoni(): View
    {
        $setting = $this->getSetting();
        $testimonials = Testimonial::orderBy('sort_order')->get();

        return view('halaman_portofolio.testimoni', compact('setting', 'testimonials'));
    }

    /**
     * Halaman tersendiri untuk Kontak & Peta Lokasi (Maps).
     */
    public function kontak(): View
    {
        $setting = $this->getSetting();

        return view('halaman_portofolio.kontak', compact('setting'));
    }

    /**
     * Memproses pesan masuk dari formulir kontak.
     */
    public function kirimPesan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'layanan' => 'nullable|string|max:100',
            'pesan' => 'required|string|max:3000',
        ]);

        ContactMessage::create($validated);

        return back()->with('sukses', 'Terima kasih, pesan Anda berhasil terkirim ke Ibrahim! Kami akan segera merespons via Email / WhatsApp.');
    }
}
