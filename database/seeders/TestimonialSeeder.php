<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::updateOrCreate(['client_name' => 'Sunita Verma'], [
            'client_position' => 'Patient, Indore',
            'client_company' => 'Central Hospital Indore',
            'avatar' => null,
            'content' => 'इलाज के दौरान पूरी टीम ने बहुत ध्यान रखा और हर बात को धैर्य से समझाया। साफ-सफाई और सुविधाएँ बेहतरीन हैं।',
            'rating' => 5,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Testimonial::updateOrCreate([
            'content' => 'Service was good Staff behaviour was like friendly',
        ], [
            'client_name' => 'Google Reviewer',
            'client_position' => 'Patient feedback',
            'client_company' => 'Google Reviews',
            'avatar' => null,
            'rating' => 5,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Testimonial::updateOrCreate([
            'content' => 'Nurses and doctors were very nice and helpful.',
        ], [
            'client_name' => 'Google Reviewer',
            'client_position' => 'Patient feedback',
            'client_company' => 'Google Reviews',
            'avatar' => null,
            'rating' => 5,
            'is_active' => true,
            'sort_order' => 3,
        ]);
    }
}
