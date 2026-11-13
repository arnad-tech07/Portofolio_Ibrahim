<?php

namespace Tests\Feature;

use App\Models\BannerSlide;
use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\ProfileSetting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CmsTest extends TestCase
{
    use RefreshDatabase;

    private User $owner;

    protected function setUp(): void
    {
        parent::setUp();

        $this->owner = User::create([
            'name' => 'Ibrahim Owner',
            'email' => 'ibrahim@portfolio.com',
            'password' => Hash::make('password123'),
        ]);
    }

    public function test_guest_is_redirected_to_login_when_accessing_cms(): void
    {
        $response = $this->get('/cms');
        $response->assertRedirect('/login');
    }

    public function test_owner_can_login_successfully(): void
    {
        $response = $this->post('/login', [
            'email' => 'ibrahim@portfolio.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/cms');
        $this->assertAuthenticatedAs($this->owner);
    }

    public function test_owner_fails_login_with_wrong_password(): void
    {
        $response = $this->post('/login', [
            'email' => 'ibrahim@portfolio.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_authenticated_owner_can_access_dashboard_and_pages(): void
    {
        $response = $this->actingAs($this->owner)->get('/cms');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Kendali Sistem');

        $this->actingAs($this->owner)->get('/cms/akun')->assertStatus(200)->assertSee('Keamanan Pemilik', false);
        $this->actingAs($this->owner)->get('/cms/pengaturan')->assertStatus(200)->assertSee('Ubah Profil');
        $this->actingAs($this->owner)->get('/cms/banner')->assertStatus(200)->assertSee('Kelola Slide Banner');
        $this->actingAs($this->owner)->get('/cms/cv')->assertStatus(200)->assertSee('Kelola Konten CV');
        $this->actingAs($this->owner)->get('/cms/pesan')->assertStatus(200);
        $this->actingAs($this->owner)->get('/cms/layanan')->assertStatus(200);
        $this->actingAs($this->owner)->get('/cms/proyek')->assertStatus(200);
        $this->actingAs($this->owner)->get('/cms/video')->assertStatus(200);
        $this->actingAs($this->owner)->get('/cms/testimoni')->assertStatus(200);
    }

    public function test_owner_can_update_email_and_password(): void
    {
        $response = $this->actingAs($this->owner)->post('/cms/akun', [
            'name' => 'Ibrahim Baru',
            'email' => 'ibrahim.baru@portfolio.com',
            'current_password' => 'password123',
            'new_password' => 'newsecret123',
            'new_password_confirmation' => 'newsecret123',
        ]);

        $response->assertSessionHas('sukses');
        $this->owner->refresh();
        $this->assertEquals('ibrahim.baru@portfolio.com', $this->owner->email);
        $this->assertEquals('Ibrahim Baru', $this->owner->name);
        $this->assertTrue(Hash::check('newsecret123', $this->owner->password));
    }

    public function test_owner_fails_password_update_with_incorrect_current_password(): void
    {
        $response = $this->actingAs($this->owner)->post('/cms/akun', [
            'name' => 'Ibrahim Owner',
            'email' => 'ibrahim@portfolio.com',
            'current_password' => 'wrong_pass',
            'new_password' => 'newsecret123',
            'new_password_confirmation' => 'newsecret123',
        ]);

        $response->assertSessionHasErrors('current_password');
    }

    public function test_owner_can_upload_avatar_file_and_cv_document(): void
    {
        Storage::fake('public');

        $avatarFile = UploadedFile::fake()->image('profile.jpg', 600, 600);
        $cvFile = UploadedFile::fake()->create('cv_ibrahim.pdf', 1024, 'application/pdf');

        $response = $this->actingAs($this->owner)->post('/cms/pengaturan', [
            'name' => 'Ibrahim Al-Fatih',
            'title' => 'Chief Technology Officer',
            'email' => 'ibrahim@portfolio.com',
            'avatar_file' => $avatarFile,
            'cv_file' => $cvFile,
        ]);

        $response->assertSessionHas('sukses');
        $setting = ProfileSetting::first();
        $this->assertNotNull($setting->avatar_url);
        $this->assertNotNull($setting->cv_download_url);
    }

    public function test_owner_can_manage_banner_slides(): void
    {
        $response = $this->actingAs($this->owner)->post('/cms/banner', [
            'badge_text' => 'Promo Spesial',
            'title' => 'Pembuatan Website UMKM Merdeka',
            'highlight_text' => 'Diskon 50%',
            'description' => 'Paket website lengkap langsung online.',
            'button1_text' => 'Pesan Sekarang',
            'button1_url' => '#kontak-section',
            'bg_gradient' => 'slide-bg-1',
            'is_active' => true,
        ]);

        $response->assertSessionHas('sukses');
        $slide = BannerSlide::where('title', 'Pembuatan Website UMKM Merdeka')->first();
        $this->assertNotNull($slide);

        // Update slide
        $this->actingAs($this->owner)->put("/cms/banner/{$slide->id}", [
            'badge_text' => 'Promo Terbatas',
            'title' => 'Pembuatan Website UMKM Go Digital',
            'description' => 'Paket website terlengkap.',
            'bg_gradient' => 'slide-bg-2',
        ]);
        $this->assertDatabaseHas('banner_slides', [
            'title' => 'Pembuatan Website UMKM Go Digital',
        ]);

        // Delete slide
        $this->actingAs($this->owner)->delete("/cms/banner/{$slide->id}");
        $this->assertDatabaseMissing('banner_slides', ['id' => $slide->id]);
    }

    public function test_owner_can_manage_cv_experiences_skills_and_education(): void
    {
        // Tambah Pengalaman
        $this->actingAs($this->owner)->post('/cms/cv/pengalaman', [
            'period' => '2024 - Sekarang',
            'role' => 'Principal Software Engineer',
            'company' => 'Mega Global Tech',
            'description' => 'Memimpin modernisasi sistem legacy.',
        ]);
        $exp = Experience::where('role', 'Principal Software Engineer')->first();
        $this->assertNotNull($exp);

        // Update Pengalaman
        $this->actingAs($this->owner)->put("/cms/cv/pengalaman/{$exp->id}", [
            'period' => '2025 - Sekarang',
            'role' => 'Chief Technology Officer',
            'company' => 'Mega Global Tech',
            'description' => 'Memimpin 50 engineer.',
        ]);
        $this->assertDatabaseHas('experiences', ['role' => 'Chief Technology Officer']);

        // Tambah Skill
        $this->actingAs($this->owner)->post('/cms/cv/skill', [
            'name' => 'Go Programming & Microservices',
            'percentage' => 88,
        ]);
        $skill = Skill::where('name', 'Go Programming & Microservices')->first();
        $this->assertNotNull($skill);

        // Update Skill
        $this->actingAs($this->owner)->put("/cms/cv/skill/{$skill->id}", [
            'name' => 'Golang Architecture',
            'percentage' => 95,
        ]);
        $this->assertDatabaseHas('skills', ['name' => 'Golang Architecture']);

        // Tambah Pendidikan
        $this->actingAs($this->owner)->post('/cms/cv/pendidikan', [
            'degree' => 'Magister Ilmu Komputer (M.Kom)',
            'institution' => 'Institut Teknologi Bandung',
            'year_graduated' => 'Lulus 2023',
        ]);
        $edu = Education::where('degree', 'Magister Ilmu Komputer (M.Kom)')->first();
        $this->assertNotNull($edu);

        // Update Pendidikan
        $this->actingAs($this->owner)->put("/cms/cv/pendidikan/{$edu->id}", [
            'degree' => 'Master of Computer Science (M.Cs)',
            'institution' => 'Institut Teknologi Bandung',
            'year_graduated' => 'Lulus Cumlaude 2023',
        ]);
        $this->assertDatabaseHas('education', ['degree' => 'Master of Computer Science (M.Cs)']);
    }

    public function test_owner_can_add_and_update_project_with_image_upload(): void
    {
        Storage::fake('public');

        $imageFile = UploadedFile::fake()->image('project_mockup.png', 800, 600);

        $response = $this->actingAs($this->owner)->post('/cms/proyek', [
            'title' => 'Aplikasi Audit Finansial',
            'category' => 'Web Application',
            'client' => 'Klien XYZ',
            'image_file' => $imageFile,
            'description' => 'Dokumentasi aplikasi audit terpusat berbasis web.',
            'tech_stack' => 'Laravel 12, PostgreSQL',
        ]);

        $response->assertSessionHas('sukses');
        $project = Project::where('title', 'Aplikasi Audit Finansial')->first();
        $this->assertNotNull($project);
        $this->assertNotNull($project->image_url);

        // Update project
        $this->actingAs($this->owner)->put("/cms/proyek/{$project->id}", [
            'title' => 'Aplikasi Audit Finansial Enterprise',
            'category' => 'Enterprise System',
            'description' => 'Dokumentasi versi 2.0 sistem audit terpusat.',
        ]);
        $this->assertDatabaseHas('projects', ['title' => 'Aplikasi Audit Finansial Enterprise']);
    }

    public function test_owner_can_update_contact_message(): void
    {
        $message = ContactMessage::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@test.com',
            'telepon' => '081234567890',
            'layanan' => 'Jasa Pembuatan Website',
            'pesan' => 'Saya butuh web toko online',
            'is_read' => false,
        ]);

        $this->actingAs($this->owner)->put("/cms/pesan/{$message->id}", [
            'nama' => 'Budi Santoso (Updated)',
            'email' => 'budi@test.com',
            'pesan' => 'Saya butuh web toko online custom',
            'admin_note' => 'Klien sudah ditelepon via WA',
            'is_read' => 1,
        ]);

        $this->assertDatabaseHas('contact_messages', [
            'id' => $message->id,
            'nama' => 'Budi Santoso (Updated)',
            'admin_note' => 'Klien sudah ditelepon via WA',
            'is_read' => 1,
        ]);
    }

    public function test_owner_can_logout(): void
    {
        $response = $this->actingAs($this->owner)->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
