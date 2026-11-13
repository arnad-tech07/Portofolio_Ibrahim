<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortofolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_with_all_sections_and_cards(): void
    {
        Service::create([
            'title' => 'Website Company Profile',
            'category' => 'website',
            'description' => 'Layanan pembuatan website korporat',
            'price' => 'Mulai Rp 1.500.000',
            'is_active' => true,
        ]);

        Project::create([
            'title' => 'Sistem Informasi Rumah Sakit',
            'category' => 'Web Application',
            'description' => 'Dokumentasi sistem informasi manajemen rumah sakit lengkap.',
            'tech_stack' => 'Laravel 12, MySQL',
        ]);

        Video::create([
            'title' => 'Demo Aplikasi Kasir',
            'category' => 'Demo Proyek',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'description' => 'Walkthrough demo aplikasi kasir modern',
        ]);

        Testimonial::create([
            'name' => 'Budi Pratama',
            'role' => 'Direktur',
            'company' => 'PT Sukses Mandiri',
            'content' => 'Layanan Mas Ibrahim sangat memuaskan dan cepat.',
            'rating' => 5,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('IBRAHIM');
        $response->assertSee('Slide Banner');
        $response->assertSee('Website Company Profile');
        $response->assertSee('Sistem Informasi Rumah Sakit');
        $response->assertSee('Demo Aplikasi Kasir');
        $response->assertSee('Budi Pratama');
        $response->assertSee('Apa Kata Mereka?');
    }

    public function test_subpages_render_successfully(): void
    {
        $this->get('/cv')->assertStatus(200)->assertSee('Curriculum Vitae Digital');
        $this->get('/layanan')->assertStatus(200)->assertSee('Layanan Profesional');
        $this->get('/dokumentasi')->assertStatus(200)->assertSee('Dokumentasi Proyek Pilihan');
        $this->get('/video')->assertStatus(200)->assertSee('Galeri Video', false);
        $this->get('/testimoni')->assertStatus(200)->assertSee('Apa Kata Mereka?');
        $this->get('/kontak')->assertStatus(200)->assertSee('Mari Berdiskusi', false);
    }

    public function test_contact_form_submits_successfully(): void
    {
        $postData = [
            'nama' => 'Ahmad Reza',
            'email' => 'reza@bisnisku.id',
            'telepon' => '081234567899',
            'layanan' => 'Jasa Pembuatan Website',
            'pesan' => 'Saya butuh penawaran pembuatan website e-commerce modern.',
        ];

        $response = $this->post('/kirim-pesan', $postData);

        $response->assertSessionHas('sukses');
        $this->assertDatabaseHas('contact_messages', [
            'nama' => 'Ahmad Reza',
            'email' => 'reza@bisnisku.id',
            'telepon' => '081234567899',
        ]);
    }

    public function test_contact_form_validates_required_fields(): void
    {
        $response = $this->post('/kirim-pesan', []);

        $response->assertSessionHasErrors(['nama', 'email', 'pesan']);
    }
}
