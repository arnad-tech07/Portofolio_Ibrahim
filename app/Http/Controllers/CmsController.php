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
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class CmsController extends Controller
{
    /**
     * Dashboard ringkasan CMS.
     */
    public function dashboard(): View
    {
        $totalServices = Service::count();
        $totalProjects = Project::count();
        $totalVideos = Video::count();
        $totalTestimonials = Testimonial::count();
        $totalMessages = ContactMessage::count();
        $totalSlides = BannerSlide::count();
        $totalExperiences = Experience::count();
        $totalSkills = Skill::count();
        $unreadMessagesCount = ContactMessage::where('is_read', false)->count();

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(4)->get();

        return view('cms.dashboard', compact(
            'totalServices',
            'totalProjects',
            'totalVideos',
            'totalTestimonials',
            'totalMessages',
            'totalSlides',
            'totalExperiences',
            'totalSkills',
            'unreadMessagesCount',
            'recentMessages',
            'recentProjects'
        ));
    }

    /**
     * ========================================================
     * KELOLA AKUN PENGGUNA (UBAH EMAIL & PASSWORD PEMILIK)
     * ========================================================
     */
    public function akun(): View
    {
        $user = Auth::user();

        return view('cms.akun', compact('user'));
    }

    public function updateAkun(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'current_password' => 'nullable|string',
            'new_password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Jika user mengisi password baru
        if (! empty($request->new_password)) {
            if (empty($request->current_password) || ! Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('sukses', 'Profil akun, email, dan kata sandi berhasil diperbarui!');
    }

    /**
     * ========================================================
     * KELOLA PESAN KONTAK MASUK
     * ========================================================
     */
    public function pesan(): View
    {
        $messages = ContactMessage::latest()->paginate(15);

        return view('cms.pesan', compact('messages'));
    }

    public function tandaiPesanDibaca(int $id): RedirectResponse
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);

        return back()->with('sukses', 'Pesan berhasil ditandai telah dibaca.');
    }

    public function updatePesan(Request $request, int $id): RedirectResponse
    {
        $message = ContactMessage::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:50',
            'layanan' => 'nullable|string|max:100',
            'pesan' => 'required|string',
            'admin_note' => 'nullable|string',
            'is_read' => 'nullable|boolean',
        ]);

        $validated['is_read'] = $request->has('is_read');
        $message->update($validated);

        return back()->with('sukses', 'Data dan catatan pesan berhasil diperbarui!');
    }

    public function destroyPesan(int $id): RedirectResponse
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return back()->with('sukses', 'Pesan kontak berhasil dihapus.');
    }

    /**
     * ========================================================
     * PENGATURAN UMUM: PROFIL, FOTO AVATAR, KONTAK, MAPS, MEDSOS
     * Mendukung upload file JPG, JPEG, PNG, SVG (ukuran besar)
     * ========================================================
     */
    public function pengaturan(): View
    {
        $setting = ProfileSetting::firstOrCreate(['id' => 1]);

        return view('cms.pengaturan', compact('setting'));
    }

    public function updatePengaturan(Request $request): RedirectResponse
    {
        $setting = ProfileSetting::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'status_text' => 'nullable|string|max:255',
            'avatar_file' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:20480', // sampai 20MB
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:25600', // sampai 25MB
            'bio_summary' => 'nullable|string',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'whatsapp_number' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'maps_embed_url' => 'nullable|string',
            'stat_years_exp' => 'nullable|string|max:50',
            'stat_projects_done' => 'nullable|string|max:50',
            'stat_students_trained' => 'nullable|string|max:50',
            'stat_client_satisfaction' => 'nullable|string|max:50',
            'github_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string|max:255',
            'youtube_url' => 'nullable|string|max:255',
            'twitter_url' => 'nullable|string|max:255',
            'footer_about' => 'nullable|string',
            'copyright_text' => 'nullable|string|max:255',
        ]);

        // Upload file foto avatar profil
        if ($request->hasFile('avatar_file')) {
            $path = $request->file('avatar_file')->store('avatars', 'public');
            $validated['avatar_url'] = asset('storage/'.$path);
        }

        // Upload file PDF CV
        if ($request->hasFile('cv_file')) {
            $path = $request->file('cv_file')->store('cv_files', 'public');
            $validated['cv_download_url'] = asset('storage/'.$path);
        }

        $setting->update($validated);

        return back()->with('sukses', 'Pengaturan profil, foto avatar, kontak, maps, medsos, dan footer berhasil diperbarui!');
    }

    /**
     * ========================================================
     * KELOLA SLIDE BANNER CAROUSEL
     * ========================================================
     */
    public function banner(): View
    {
        $slides = BannerSlide::orderBy('sort_order')->get();

        return view('cms.banner', compact('slides'));
    }

    public function storeBanner(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'badge_text' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'description' => 'required|string',
            'button1_text' => 'nullable|string|max:100',
            'button1_url' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:100',
            'button2_url' => 'nullable|string|max:255',
            'mockup_icon' => 'nullable|string|max:100',
            'mockup_title' => 'nullable|string|max:100',
            'mockup_desc' => 'nullable|string|max:255',
            'mockup_stat1_val' => 'nullable|string|max:50',
            'mockup_stat1_label' => 'nullable|string|max:50',
            'mockup_stat2_val' => 'nullable|string|max:50',
            'mockup_stat2_label' => 'nullable|string|max:50',
            'bg_gradient' => 'required|string|max:50',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = BannerSlide::max('sort_order') + 1;

        BannerSlide::create($validated);

        return back()->with('sukses', 'Slide banner carousel baru berhasil ditambahkan!');
    }

    public function updateBanner(Request $request, int $id): RedirectResponse
    {
        $slide = BannerSlide::findOrFail($id);

        $validated = $request->validate([
            'badge_text' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'description' => 'required|string',
            'button1_text' => 'nullable|string|max:100',
            'button1_url' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:100',
            'button2_url' => 'nullable|string|max:255',
            'mockup_icon' => 'nullable|string|max:100',
            'mockup_title' => 'nullable|string|max:100',
            'mockup_desc' => 'nullable|string|max:255',
            'mockup_stat1_val' => 'nullable|string|max:50',
            'mockup_stat1_label' => 'nullable|string|max:50',
            'mockup_stat2_val' => 'nullable|string|max:50',
            'mockup_stat2_label' => 'nullable|string|max:50',
            'bg_gradient' => 'required|string|max:50',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $slide->update($validated);

        return back()->with('sukses', 'Slide banner carousel berhasil diperbarui!');
    }

    public function destroyBanner(int $id): RedirectResponse
    {
        $slide = BannerSlide::findOrFail($id);
        $slide->delete();

        return back()->with('sukses', 'Slide banner carousel berhasil dihapus.');
    }

    /**
     * ========================================================
     * KELOLA CV (PENGALAMAN KERJA, SKILL, SERTIFIKASI & PENDIDIKAN)
     * ========================================================
     */
    public function cv(): View
    {
        $experiences = Experience::orderBy('sort_order')->get();
        $skills = Skill::orderBy('sort_order')->get();
        $certifications = Certification::orderBy('sort_order')->get();
        $educations = Education::orderBy('sort_order')->get();

        return view('cms.cv', compact('experiences', 'skills', 'certifications', 'educations'));
    }

    // 1. Pengalaman Kerja
    public function storePengalaman(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'period' => 'required|string|max:100',
            'role' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $validated['sort_order'] = Experience::max('sort_order') + 1;
        Experience::create($validated);

        return back()->with('sukses', 'Pengalaman kerja baru berhasil ditambahkan!');
    }

    public function updatePengalaman(Request $request, int $id): RedirectResponse
    {
        $exp = Experience::findOrFail($id);
        $validated = $request->validate([
            'period' => 'required|string|max:100',
            'role' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $exp->update($validated);

        return back()->with('sukses', 'Data pengalaman kerja berhasil diperbarui!');
    }

    public function destroyPengalaman(int $id): RedirectResponse
    {
        Experience::findOrFail($id)->delete();

        return back()->with('sukses', 'Pengalaman kerja berhasil dihapus.');
    }

    // 2. Skill Bar
    public function storeSkill(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:1|max:100',
            'category' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
        ]);

        $validated['sort_order'] = Skill::max('sort_order') + 1;
        Skill::create($validated);

        return back()->with('sukses', 'Keahlian teknis berhasil ditambahkan!');
    }

    public function updateSkill(Request $request, int $id): RedirectResponse
    {
        $skill = Skill::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:1|max:100',
            'category' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
        ]);

        $skill->update($validated);

        return back()->with('sukses', 'Data keahlian teknis berhasil diperbarui!');
    }

    public function destroySkill(int $id): RedirectResponse
    {
        Skill::findOrFail($id)->delete();

        return back()->with('sukses', 'Keahlian teknis berhasil dihapus.');
    }

    // 3. Sertifikasi
    public function storeSertifikasi(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'year' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:100',
            'icon_color' => 'nullable|string|max:50',
        ]);

        $validated['sort_order'] = Certification::max('sort_order') + 1;
        Certification::create($validated);

        return back()->with('sukses', 'Sertifikasi profesional berhasil ditambahkan!');
    }

    public function updateSertifikasi(Request $request, int $id): RedirectResponse
    {
        $cert = Certification::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'year' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:100',
            'icon_color' => 'nullable|string|max:50',
        ]);

        $cert->update($validated);

        return back()->with('sukses', 'Data sertifikasi berhasil diperbarui!');
    }

    public function destroySertifikasi(int $id): RedirectResponse
    {
        Certification::findOrFail($id)->delete();

        return back()->with('sukses', 'Sertifikasi berhasil dihapus.');
    }

    // 4. Pendidikan Formal
    public function storePendidikan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'year_graduated' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
        ]);

        $validated['sort_order'] = Education::max('sort_order') + 1;
        Education::create($validated);

        return back()->with('sukses', 'Riwayat pendidikan berhasil ditambahkan!');
    }

    public function updatePendidikan(Request $request, int $id): RedirectResponse
    {
        $edu = Education::findOrFail($id);
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'year_graduated' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
        ]);

        $edu->update($validated);

        return back()->with('sukses', 'Riwayat pendidikan berhasil diperbarui!');
    }

    public function destroyPendidikan(int $id): RedirectResponse
    {
        Education::findOrFail($id)->delete();

        return back()->with('sukses', 'Riwayat pendidikan berhasil dihapus.');
    }

    /**
     * ========================================================
     * KELOLA LAYANAN (WEBSITE & TRAINING)
     * ========================================================
     */
    public function layanan(): View
    {
        $services = Service::orderBy('sort_order')->get();

        return view('cms.layanan', compact('services'));
    }

    public function storeLayanan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:website,training',
            'icon' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:50',
            'short_desc' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'nullable|string|max:100',
            'features_text' => 'nullable|string',
        ]);

        $features = [];
        if (! empty($validated['features_text'])) {
            $features = array_filter(array_map('trim', explode("\n", $validated['features_text'])));
        }

        Service::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'icon' => $validated['icon'] ?? 'fa-solid fa-code',
            'badge' => $validated['badge'],
            'short_desc' => $validated['short_desc'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'features' => array_values($features),
            'is_active' => $request->has('is_active'),
            'sort_order' => Service::max('sort_order') + 1,
        ]);

        return back()->with('sukses', 'Layanan baru berhasil ditambahkan!');
    }

    public function updateLayanan(Request $request, int $id): RedirectResponse
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:website,training',
            'icon' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:50',
            'short_desc' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'nullable|string|max:100',
            'features_text' => 'nullable|string',
        ]);

        $features = [];
        if (! empty($validated['features_text'])) {
            $features = array_filter(array_map('trim', explode("\n", $validated['features_text'])));
        }

        $service->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'icon' => $validated['icon'] ?? $service->icon,
            'badge' => $validated['badge'],
            'short_desc' => $validated['short_desc'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'features' => array_values($features),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('sukses', 'Data layanan berhasil diperbarui!');
    }

    public function destroyLayanan(int $id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return back()->with('sukses', 'Layanan berhasil dihapus.');
    }

    /**
     * ========================================================
     * KELOLA CARD DOKUMENTASI PROYEK
     * Mendukung Upload Gambar JPG, JPEG, PNG, SVG (Ukuran Besar)
     * ========================================================
     */
    public function proyek(): View
    {
        $projects = Project::orderBy('sort_order')->get();

        return view('cms.proyek', compact('projects'));
    }

    public function storeProyek(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'client' => 'nullable|string|max:255',
            'image_file' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:20480',
            'description' => 'required|string',
            'tech_stack' => 'nullable|string|max:255',
            'demo_url' => 'nullable|string|max:255',
            'github_url' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('projects', 'public');
            $validated['image_url'] = asset('storage/'.$path);
        }

        $validated['sort_order'] = Project::max('sort_order') + 1;
        Project::create($validated);

        return back()->with('sukses', 'Dokumentasi proyek baru berhasil ditambahkan!');
    }

    public function updateProyek(Request $request, int $id): RedirectResponse
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'client' => 'nullable|string|max:255',
            'image_file' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:20480',
            'description' => 'required|string',
            'tech_stack' => 'nullable|string|max:255',
            'demo_url' => 'nullable|string|max:255',
            'github_url' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('projects', 'public');
            $validated['image_url'] = asset('storage/'.$path);
        }

        $project->update($validated);

        return back()->with('sukses', 'Dokumentasi proyek berhasil diperbarui!');
    }

    public function destroyProyek(int $id): RedirectResponse
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return back()->with('sukses', 'Dokumentasi proyek berhasil dihapus.');
    }

    /**
     * ========================================================
     * KELOLA CARD VIDEO SHOWCASE
     * Mendukung Upload Thumbnail JPG, JPEG, PNG, SVG (Ukuran Besar)
     * ========================================================
     */
    public function video(): View
    {
        $videos = Video::orderBy('sort_order')->get();

        return view('cms.video', compact('videos'));
    }

    public function storeVideo(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'video_url' => 'required|string|max:500',
            'thumbnail_file' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:20480',
            'duration' => 'nullable|string|max:20',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('videos', 'public');
            $validated['thumbnail_url'] = asset('storage/'.$path);
        }

        $validated['sort_order'] = Video::max('sort_order') + 1;
        Video::create($validated);

        return back()->with('sukses', 'Video baru berhasil ditambahkan!');
    }

    public function updateVideo(Request $request, int $id): RedirectResponse
    {
        $video = Video::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'video_url' => 'required|string|max:500',
            'thumbnail_file' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:20480',
            'duration' => 'nullable|string|max:20',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('videos', 'public');
            $validated['thumbnail_url'] = asset('storage/'.$path);
        }

        $video->update($validated);

        return back()->with('sukses', 'Data video berhasil diperbarui!');
    }

    public function destroyVideo(int $id): RedirectResponse
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return back()->with('sukses', 'Video berhasil dihapus.');
    }

    /**
     * ========================================================
     * KELOLA APA KATA MEREKA (TESTIMONI)
     * Mendukung Upload Avatar JPG, JPEG, PNG, SVG (Ukuran Besar)
     * ========================================================
     */
    public function testimoni(): View
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();

        return view('cms.testimoni', compact('testimonials'));
    }

    public function storeTestimoni(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'avatar_file' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:20480',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($request->hasFile('avatar_file')) {
            $path = $request->file('avatar_file')->store('testimonials', 'public');
            $validated['avatar_url'] = asset('storage/'.$path);
        }

        $validated['sort_order'] = Testimonial::max('sort_order') + 1;
        Testimonial::create($validated);

        return back()->with('sukses', 'Testimoni klien berhasil ditambahkan!');
    }

    public function updateTestimoni(Request $request, int $id): RedirectResponse
    {
        $testi = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'avatar_file' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:20480',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($request->hasFile('avatar_file')) {
            $path = $request->file('avatar_file')->store('testimonials', 'public');
            $validated['avatar_url'] = asset('storage/'.$path);
        }

        $testi->update($validated);

        return back()->with('sukses', 'Testimoni berhasil diperbarui!');
    }

    public function destroyTestimoni(int $id): RedirectResponse
    {
        $testi = Testimonial::findOrFail($id);
        $testi->delete();

        return back()->with('sukses', 'Testimoni berhasil dihapus.');
    }
}
