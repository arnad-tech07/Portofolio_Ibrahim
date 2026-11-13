<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profile_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Ibrahim');
            $table->string('title')->default('Senior Fullstack Web Developer & Tech Lead');
            $table->string('status_text')->default('Tersedia untuk Jasa & Training');
            $table->string('avatar_url')->nullable();
            $table->string('cv_download_url')->nullable();
            $table->text('bio_summary')->nullable();
            $table->string('email')->default('ibrahim@portfolio.com');
            $table->string('phone')->default('+62 812-3456-7890');
            $table->string('whatsapp_number')->default('6281234567890');
            $table->string('location')->default('Jakarta & Bandung, Indonesia');
            $table->string('working_hours')->default('Senin - Sabtu (08:00 - 21:00 WIB)');
            $table->text('maps_embed_url')->nullable();
            $table->string('stat_years_exp')->default('7+ Tahun');
            $table->string('stat_projects_done')->default('120+');
            $table->string('stat_students_trained')->default('500+');
            $table->string('stat_client_satisfaction')->default('99.8%');
            $table->string('github_url')->default('https://github.com');
            $table->string('linkedin_url')->default('https://linkedin.com');
            $table->string('instagram_url')->default('https://instagram.com');
            $table->string('youtube_url')->default('https://youtube.com');
            $table->string('twitter_url')->default('https://twitter.com');
            $table->text('footer_about')->nullable();
            $table->string('copyright_text')->default('Ibrahim Digital Portfolio. Hak Cipta Dilindungi Undang-Undang.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_settings');
    }
};
