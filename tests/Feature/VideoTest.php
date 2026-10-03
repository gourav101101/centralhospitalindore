<?php
namespace Tests\Feature;
use App\Models\{User, Video};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class VideoTest extends TestCase
{
    use RefreshDatabase;
    public function test_admin_can_manage_videos_and_public_visibility(): void
    {
        $this->get(route('admin.videos.index'))->assertRedirect(route('admin.login'));
        $this->post(route('admin.videos.store'), [])->assertRedirect(route('admin.login'));
        $this->actingAs(User::factory()->create());
        $this->get(route('admin.videos.index'))->assertOk();
        $this->get(route('admin.videos.create'))->assertOk();
        $data = ['title' => 'Hospital video test', 'youtube_url' => 'https://youtu.be/Abcdef123_-', 'description' => 'Hospital video description', 'is_active' => 1, 'sort_order' => 2];
        $this->post(route('admin.videos.store'), $data)->assertSessionHasNoErrors()->assertRedirect(route('admin.videos.index'));
        $video = Video::sole();
        $this->assertSame('Abcdef123_-', $video->youtube_id);
        $this->get(route('admin.videos.edit', $video))->assertOk()->assertSee($video->youtube_url);
        $this->get(route('videos'))->assertOk()->assertSee($video->title)->assertSee($video->embed_url);
        $this->get(route('home'))->assertOk()->assertSee($video->title);
        $this->put(route('admin.videos.update', $video), array_merge($data, ['title' => 'Hidden edited video', 'is_active' => 0]))->assertSessionHasNoErrors();
        $this->get(route('videos'))->assertDontSee('Hidden edited video')->assertDontSee('youtube-nocookie.com/embed/');
        $this->get(route('home'))->assertDontSee('home-videos-title');
        $this->delete(route('admin.videos.destroy', $video))->assertRedirect(route('admin.videos.index'));
        $this->assertDatabaseCount('videos', 0);
    }
    public function test_youtube_links_are_normalized_and_untrusted_urls_are_rejected(): void
    {
        foreach (['https://www.youtube.com/watch?v=Abcdef123_-&t=10', 'https://youtu.be/Abcdef123_-?si=abc', 'https://youtube.com/shorts/Abcdef123_-', 'https://m.youtube.com/live/Abcdef123_-', 'https://www.youtube-nocookie.com/embed/Abcdef123_-'] as $url) {
            $this->assertSame('Abcdef123_-', Video::idFromUrl($url));
        }
        $this->actingAs(User::factory()->create());
        foreach (['https://evil.example/watch?v=Abcdef123_-', 'https://youtube.com.evil.example/watch?v=Abcdef123_-', 'javascript:alert(1)', 'https://youtube.com/watch?v[]=Abcdef123_-', 'https://youtube.com/playlist?list=abc', 'https://youtube.com/watch?v=short', 'https://youtube.com@evil.example/watch?v=Abcdef123_-'] as $url) {
            $this->post(route('admin.videos.store'), ['title' => 'Invalid', 'youtube_url' => $url])->assertSessionHasErrors('youtube_url');
        }
        $this->assertDatabaseCount('videos', 0);
    }
    public function test_homepage_limit_order_and_video_pagination(): void
    {
        for ($i = 1; $i <= 11; $i++) {
            Video::create(['title' => sprintf('Video number %02d', $i), 'youtube_id' => 'Abcdef123_-', 'is_active' => true, 'sort_order' => $i]);
        }
        $this->get(route('home'))->assertSeeInOrder(['Video number 01', 'Video number 02', 'Video number 03'])->assertDontSee('Video number 04');
        $this->get(route('videos'))->assertSee('Video number 09')->assertDontSee('Video number 10');
        $this->get(route('videos', ['page' => 2]))->assertSee('Video number 10')->assertSee('Video number 11');
    }
}
