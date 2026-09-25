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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            // General Info
            $table->string('hospital_name')->default('Central Hospital Indore');
            $table->string('hospital_short_name')->default('Central Hospital Indore');
            
            // Contact
            $table->string('phone_display')->nullable();
            $table->string('phone_href')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('working_hours')->nullable();
            
            // SEO & Maps
            $table->string('google_rating')->nullable();
            $table->integer('google_review_count')->nullable();
            $table->text('maps_url')->nullable();
            $table->text('directions_url')->nullable();
            $table->text('map_embed_url')->nullable();
            $table->text('outside_view_url')->nullable();
            $table->text('meta_description')->nullable();

            // Social
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();

            // Announcement Bar
            $table->boolean('show_announcement')->default(true);
            $table->string('announcement_text')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
