<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SiteSetting::firstOrCreate(
            ['id' => 1],
            [
                'hospital_name' => 'Central Hospital Indore',
                'hospital_short_name' => 'CHI',
                'phone_display' => '+91 92430 60260',
                'phone_href' => '+919243060260',
                'whatsapp_number' => '+919243060260',
                'email' => 'info@centralhospitalindore.com',
                'address_line_1' => 'Behind Hotel Wow Crest, Near Rasoma Square',
                'address_line_2' => 'Indore, Madhya Pradesh – 452010',
                'working_hours' => 'Open 24 hours',
                'google_rating' => '5.0',
                'google_review_count' => 1,
                'maps_url' => 'https://www.google.com/maps/search/?api=1&query=Central+Hospital+Indore+Near+Rasoma+Square',
                'directions_url' => 'https://www.google.com/maps/dir/?api=1&destination=Central+Hospital+Indore%2C+Near+Rasoma+Square%2C+Indore',
                'map_embed_url' => 'https://maps.google.com/maps?q=Central+Hospital+Indore%2C+Near+Rasoma+Square%2C+Indore&output=embed',
                'outside_view_url' => '',
                'meta_description' => 'Central Hospital Indore is a leading multi-speciality quaternary care hospital delivering world-class treatment with compassion and innovation.',
                'facebook_url' => '',
                'instagram_url' => '',
                'twitter_url' => '',
                'youtube_url' => '',
                'show_announcement' => true,
                'announcement_text' => '24×7 emergency and trauma care. Call +91 92430 60260.',
            ]
        );
    }
}
