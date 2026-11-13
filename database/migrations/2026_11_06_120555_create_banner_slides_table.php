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
        Schema::create('banner_slides', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text');
            $table->string('title');
            $table->string('highlight_text')->nullable();
            $table->text('description');
            $table->string('button1_text')->nullable();
            $table->string('button1_url')->nullable();
            $table->string('button2_text')->nullable();
            $table->string('button2_url')->nullable();
            $table->string('mockup_icon')->default('fa-solid fa-code');
            $table->string('mockup_title')->nullable();
            $table->string('mockup_desc')->nullable();
            $table->string('mockup_stat1_val')->nullable();
            $table->string('mockup_stat1_label')->nullable();
            $table->string('mockup_stat2_val')->nullable();
            $table->string('mockup_stat2_label')->nullable();
            $table->string('bg_gradient')->default('slide-bg-1');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_slides');
    }
};
