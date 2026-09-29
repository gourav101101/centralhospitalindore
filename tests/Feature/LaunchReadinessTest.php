<?php

namespace Tests\Feature;

use App\Models\Brochure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaunchReadinessTest extends TestCase
{
    use RefreshDatabase;

    public function test_missing_downloads_are_not_shown(): void
    {
        Brochure::create(['file_path' => 'downloads/missing.pdf', 'original_name' => 'Missing brochure']);
        $this->get(route('downloads'))->assertOk()->assertDontSee('Missing brochure')->assertDontSee('AVARK');
    }

    public function test_contact_is_saved_before_optional_whatsapp_follow_up(): void
    {
        $this->post(route('contact.store'), [
            'name' => 'Test visitor', 'email' => 'visitor@example.com',
            'subject' => 'Consultation', 'message' => 'Please contact me about availability.',
        ])->assertRedirect(route('contact').'#contact-form-container')
            ->assertSessionHas('contact_success', true)
            ->assertSessionHas('contact_whatsapp_url', fn ($url) => str_starts_with($url, 'https://wa.me/'));
        $this->assertDatabaseHas('contact_messages', ['email' => 'visitor@example.com']);
        $this->get(route('contact'))->assertSee('Continue on WhatsApp')->assertSee('Your request is saved.');
    }

    public function test_search_endpoints_and_launch_copy(): void
    {
        $xml = $this->get('/sitemap.xml')->assertOk()->getContent();
        $this->assertNotFalse(simplexml_load_string($xml));
        $this->assertStringContainsString(route('about'), $xml);
        $this->assertStringNotContainsString('/admin', $xml);
        $this->get('/robots.txt')->assertOk()->assertSee('Disallow: /admin')->assertSee(route('sitemap'));
        $this->get('/')->assertOk()->assertSee('Open 24 hours')->assertDontSee('Hospital under construction')->assertSee('rel="canonical"', false);
    }

    public function test_repeated_login_attempts_are_limited(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('admin.login.store'), ['email' => 'invalid@example.com', 'password' => 'invalid'])->assertRedirect();
        }
        $this->post(route('admin.login.store'), ['email' => 'invalid@example.com', 'password' => 'invalid'])->assertStatus(429);
    }

    public function test_public_form_attempts_are_limited(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('contact.store'), [])->assertRedirect();
        }
        $this->post(route('contact.store'), [])->assertStatus(429);
    }
}
