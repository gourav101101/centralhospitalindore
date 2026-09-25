<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthLibraryTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_currently_published_articles_are_visible_to_visitors(): void
    {
        $published = Blog::create([
            'title' => 'Heart health guide',
            'author' => 'CHI Team',
            'tag' => 'Cardiology',
            'content' => 'Helpful heart health guidance.',
            'is_published' => true,
            'published_at' => today(),
        ]);
        Blog::create([
            'title' => 'Private draft',
            'author' => 'CHI Team',
            'content' => 'Not for public viewing.',
            'is_published' => false,
        ]);

        $this->get(route('health-library'))
            ->assertOk()
            ->assertSee($published->title)
            ->assertDontSee('Private draft');

        $this->get(route('health-article', $published))->assertOk()->assertSee($published->content);
    }
}
