<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('blogs')->where('author', 'like', 'CHI %')->get()->each(function ($blog): void {
            DB::table('blogs')->where('id', $blog->id)->update([
                'author' => str_replace('CHI ', 'Central Hospital Indore ', $blog->author),
                'updated_at' => now(),
            ]);
        });

        DB::table('testimonials')->where('client_name', 'Sarah Johnson')->update([
            'client_name' => 'Google Reviewer', 'client_position' => 'Patient feedback',
            'client_company' => 'Google Reviews', 'avatar' => null,
            'content' => 'Service was good Staff behaviour was like friendly',
            'rating' => 5, 'sort_order' => 1, 'updated_at' => now(),
        ]);

        DB::table('testimonials')->where('client_name', 'Michael Chen')->update([
            'client_name' => 'Google Reviewer', 'client_position' => 'Patient feedback',
            'client_company' => 'Google Reviews', 'avatar' => null,
            'content' => 'Nurses and doctors were very nice and helpful.',
            'rating' => 5, 'sort_order' => 2, 'updated_at' => now(),
        ]);

        DB::table('testimonials')->where('client_name', 'Dr. Emily Carter')->delete();
    }

    public function down(): void
    {
        DB::table('blogs')->where('author', 'like', 'Central Hospital Indore %')->get()->each(function ($blog): void {
            DB::table('blogs')->where('id', $blog->id)->update([
                'author' => str_replace('Central Hospital Indore ', 'CHI ', $blog->author),
                'updated_at' => now(),
            ]);
        });

        DB::table('testimonials')->where('content', 'Service was good Staff behaviour was like friendly')->update([
            'client_name' => 'Sarah Johnson', 'client_position' => 'Marketing Manager',
            'client_company' => 'Growthly', 'avatar' => 'assets/imgs/home-1/testimonial/kptestimonails01.png',
            'content' => 'This CRM has transformed how we manage campaigns. Simple, effective, and a game-changer for our CRM team’s productivity.',
            'sort_order' => 1, 'updated_at' => now(),
        ]);

        DB::table('testimonials')->where('content', 'Nurses and doctors were very nice and helpful.')->update([
            'client_name' => 'Michael Chen', 'client_position' => 'Operations Director',
            'client_company' => 'TechFlow', 'avatar' => 'assets/imgs/home-1/testimonial/kptestimonails02.png',
            'content' => 'The ERP system provided by Avark has completely streamlined our internal processes. We\'ve seen a 40% increase in operational efficiency.',
            'sort_order' => 2, 'updated_at' => now(),
        ]);

        DB::table('testimonials')->insert([
            'client_name' => 'Dr. Emily Carter', 'client_position' => 'Chief Medical Officer',
            'client_company' => 'City Health Clinic', 'avatar' => 'assets/imgs/home-1/testimonial/author-1.jpg',
            'content' => 'Their Hospital Management System is robust and intuitive. It has significantly reduced our administrative overhead and improved patient care.',
            'rating' => 5, 'is_active' => true, 'sort_order' => 3,
            'created_at' => now(), 'updated_at' => now(),
        ]);
    }
};
