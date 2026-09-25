<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class HealthLibrarySeeder extends Seeder
{
    /**
     * Seed current, patient-facing articles for the Health Library.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Simple Ways to Support Heart Health Every Day',
                'slug' => 'everyday-heart-health',
                'author' => 'Central Hospital Indore Cardiology Team',
                'tag' => 'Cardiology',
                'content' => "Heart health starts with small, consistent choices. Aim for regular movement, balanced meals, adequate sleep, and routine check-ups when advised by your doctor.\n\nSeek urgent medical care for chest pain, severe breathlessness, fainting, or sudden weakness.",
                'published_at' => now()->subDays(6)->toDateString(),
            ],
            [
                'title' => 'When Should You See an Orthopedic Specialist?',
                'slug' => 'when-to-see-an-orthopedic-specialist',
                'author' => 'Central Hospital Indore Orthopaedics Team',
                'tag' => 'Orthopedics',
                'content' => "Persistent joint pain, swelling after an injury, limited movement, or pain that interrupts daily life can be reasons to consult an orthopedic specialist.\n\nEarly assessment can help identify the cause and guide safe treatment, rehabilitation, and activity changes.",
                'published_at' => now()->subDays(4)->toDateString(),
            ],
            [
                'title' => 'A Parent’s Guide to Routine Child Wellness Visits',
                'slug' => 'routine-child-wellness-visits',
                'author' => 'Central Hospital Indore Paediatrics Team',
                'tag' => 'Pediatrics',
                'content' => "Regular wellness visits help monitor a child’s growth, development, nutrition, and immunization schedule. They are also a good time to discuss sleep, feeding, school concerns, and any changes you have noticed.\n\nKeep your child’s vaccination record and a short list of questions ready for the visit.",
                'published_at' => now()->subDays(2)->toDateString(),
            ],
        ];

        foreach ($articles as $article) {
            Blog::updateOrCreate(
                ['slug' => $article['slug']],
                [...$article, 'is_published' => true],
            );
        }
    }
}
