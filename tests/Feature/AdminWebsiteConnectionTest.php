<?php

namespace Tests\Feature;

use App\Models\{Appointment, Blog, Brochure, ContactMessage, Department, Doctor, Gallery, PatientFeedback, SiteSetting, Testimonial, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\{File, Storage};
use Tests\TestCase;

class AdminWebsiteConnectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_protection_and_logout(): void
    {
        $this->get('/admin')->assertRedirect(route('admin.login'));
        $user = User::factory()->create(['password' => bcrypt('test-password-123')]);
        $this->post(route('admin.login.store'), ['email' => $user->email, 'password' => 'test-password-123'])->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
        $this->get(route('admin.dashboard'))->assertOk();
        $this->post(route('admin.logout'))->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }

    public function test_admin_pages_and_edit_forms_render(): void
    {
        $this->actingAs(User::factory()->create());
        foreach (['dashboard', 'appointments', 'enquiries', 'directory', 'doctors.index', 'doctors.create', 'departments.index', 'departments.create', 'blogs.index', 'blogs.create', 'gallery.index', 'gallery.create', 'testimonials.index', 'testimonials.create', 'settings', 'feedback.index', 'brochures.index'] as $name) {
            $this->get(route('admin.'.$name))->assertOk();
        }
        $records = [
            'doctors' => Doctor::create(['name' => 'Dr Connection', 'designation' => 'Consultant', 'department' => 'Medicine']),
            'departments' => Department::create(['name' => 'Medicine']),
            'blogs' => Blog::create(['title' => 'Connection article', 'author' => 'Team', 'content' => 'Article body']),
            'gallery' => Gallery::create(['image' => 'gallery/test.jpg', 'caption' => 'Test gallery']),
            'testimonials' => Testimonial::create(['client_name' => 'Test patient', 'content' => 'Test story']),
        ];
        foreach ($records as $resource => $record) {
            $this->get(route('admin.'.$resource.'.edit', $record))->assertOk();
        }
    }

    public function test_website_submissions_arrive_in_admin_and_can_be_updated(): void
    {
        Department::create(['name' => 'Medicine', 'is_active' => true]);
        $this->post(route('appointment.store'), ['patient_name' => 'Connection patient', 'phone' => '9876543210', 'department' => 'Medicine', 'preferred_date' => today()->addDay()->toDateString(), 'time_slot' => 'morning-1'])->assertSessionHasNoErrors();
        $this->post(route('contact.store'), ['name' => 'Connection visitor', 'email' => 'connection@example.com', 'subject' => 'Connection enquiry', 'message' => 'Please help with booking.'])->assertSessionHasNoErrors();
        $this->from(route('patient-stories'))->post(route('feedback.store'), ['patient_name' => 'Feedback visitor', 'department' => 'OPD', 'rating' => 4, 'feedback' => 'Connection feedback'])->assertSessionHasNoErrors();
        $appointment = Appointment::sole(); $enquiry = ContactMessage::sole(); $feedback = PatientFeedback::sole();
        $this->actingAs(User::factory()->create());
        $this->get(route('admin.appointments'))->assertOk()->assertSee('Connection patient');
        $this->get(route('admin.appointments.show', $appointment))->assertOk();
        $this->patch(route('admin.appointments.update', $appointment), ['status' => 'confirmed', 'admin_notes' => 'Confirmed in test'])->assertSessionHasNoErrors();
        $this->assertSame('confirmed', $appointment->fresh()->status);
        $this->get(route('admin.enquiries'))->assertOk()->assertSee('Connection visitor');
        $this->get(route('admin.enquiries.show', $enquiry))->assertOk();
        $this->patch(route('admin.enquiries.update', $enquiry), ['status' => 'resolved'])->assertSessionHasNoErrors();
        $this->assertSame('resolved', $enquiry->fresh()->status);
        $this->get(route('admin.feedback.index'))->assertOk()->assertSee('Connection feedback');
        $this->patch(route('admin.feedback.update', $feedback), ['status' => 'approved'])->assertSessionHasNoErrors();
        $this->assertSame('approved', $feedback->fresh()->status);
        $this->get(route('patient-stories'))->assertDontSee('Connection feedback');
    }

    public function test_admin_content_changes_are_visible_on_website(): void
    {
        $this->actingAs(User::factory()->create());
        $this->post(route('admin.departments.store'), ['name' => 'Connection medicine', 'description' => 'Connection speciality', 'is_active' => 1])->assertSessionHasNoErrors();
        $this->post(route('admin.doctors.store'), ['name' => 'Dr Connection', 'designation' => 'Consultant', 'department' => 'Connection medicine', 'is_active' => 1])->assertSessionHasNoErrors();
        $this->get(route('services'))->assertSee('Connection medicine');
        $this->get(route('doctors'))->assertSee('Dr Connection');
        $this->get(route('doctor.profile', Doctor::sole()))->assertOk();
        $this->get(route('appointment'))->assertSee('Dr Connection');
        $this->put(route('admin.departments.update', Department::sole()), ['name' => 'Renamed medicine', 'is_active' => 1])->assertSessionHasNoErrors();
        $this->assertSame('Renamed medicine', Doctor::sole()->department);
        $this->post(route('admin.blogs.store'), ['title' => 'Connection article', 'author' => 'Team', 'content' => 'Connection article body', 'is_published' => 1])->assertSessionHasNoErrors();
        $this->get(route('health-library'))->assertSee('Connection article');
        $this->get(route('health-article', Blog::sole()))->assertOk()->assertSee('Connection article body');
        $this->post(route('admin.testimonials.store'), ['client_name' => 'Connection story author', 'content' => 'Connection public story', 'rating' => 5, 'is_active' => 1])->assertSessionHasNoErrors();
        $this->get(route('patient-stories'))->assertSee('Connection public story');
        $this->get(route('home'))->assertSee('Connection public story')->assertSee('Dr Connection');
        $this->put(route('admin.doctors.update', Doctor::sole()), ['name' => 'Dr Connection', 'designation' => 'Consultant', 'department' => 'Renamed medicine', 'is_active' => 0])->assertSessionHasNoErrors();
        $this->get(route('doctors'))->assertDontSee('Dr Connection');
        $this->get(route('doctor.profile', Doctor::sole()))->assertNotFound();
    }

    public function test_brochure_upload_is_downloadable_and_removable(): void
    {
        $root = storage_path('framework/testing/brochures-'.uniqid());
        File::ensureDirectoryExists($root);
        config(['filesystems.web_root' => $root]);
        try {
            $this->actingAs(User::factory()->create());
            $this->post(route('admin.brochures.store'), ['brochure' => UploadedFile::fake()->create('connection.pdf', 5, 'application/pdf')])->assertSessionHasNoErrors()->assertRedirect(route('admin.brochures.index'));
            $brochure = Brochure::sole();
            $this->assertFileExists($root.'/'.$brochure->file_path);
            $this->get(route('downloads'))->assertOk()->assertSee('connection.pdf')->assertSee(asset($brochure->file_path));
            $this->delete(route('admin.brochures.destroy', $brochure))->assertRedirect(route('admin.brochures.index'));
            $this->assertDatabaseCount('brochures', 0);
            $this->assertFileDoesNotExist($root.'/'.$brochure->file_path);
        } finally {
            File::deleteDirectory($root);
        }
    }

    public function test_settings_update_public_contact_details_and_validate_input(): void
    {
        $this->actingAs(User::factory()->create());
        $data = ['phone_display' => '0731 1234567', 'phone_href' => '+917311234567', 'whatsapp_number' => '919876543210', 'email' => 'connection@example.com', 'working_hours' => 'Open 24 hours', 'address_line_1' => 'Connection hospital address', 'maps_url' => 'https://maps.google.com/?q=indore', 'google_review_count' => 25];
        $this->put(route('admin.settings.update'), $data)->assertSessionHasNoErrors();
        $this->get(route('contact'))->assertOk()->assertSee('connection@example.com')->assertSee('Connection hospital address');
        $this->assertSame($data['maps_url'], SiteSetting::sole()->maps_url);
        $this->put(route('admin.settings.update'), array_merge($data, ['email' => 'invalid', 'google_review_count' => -2]))->assertSessionHasErrors(['email', 'google_review_count']);
    }

    public function test_doctor_departments_and_article_urls_remain_valid_after_edits(): void
    {
        $this->actingAs(User::factory()->create());
        $department = Department::create(['name' => 'Medicine', 'is_active' => true]);
        $doctor = Doctor::create(['name' => 'Dr Test', 'designation' => 'Consultant', 'department' => 'Medicine']);
        $this->post(route('admin.doctors.store'), ['name' => 'Dr Invalid', 'designation' => 'Consultant', 'department' => 'Unknown'])->assertSessionHasErrors('department');
        $this->delete(route('admin.departments.destroy', $department))->assertSessionHasErrors('department');
        $this->assertModelExists($department);
        $blog = Blog::create(['title' => 'Original article', 'author' => 'Team', 'content' => 'Original body', 'is_published' => true]);
        $this->put(route('admin.blogs.update', $blog), ['title' => 'Original article', 'slug' => '', 'author' => 'Team', 'content' => 'Updated body', 'is_published' => 1])->assertSessionHasNoErrors();
        $this->get(route('health-article', $blog->fresh()))->assertOk()->assertSee('Updated body');
        $this->put(route('admin.blogs.update', $blog), ['title' => 'Original article', 'slug' => 'invalid/path', 'author' => 'Team', 'content' => 'Updated body'])->assertSessionHasErrors('slug');
    }

    public function test_gallery_and_doctor_uploads_are_connected_to_public_pages(): void
    {
        $root = storage_path('framework/testing/images-'.uniqid());
        File::ensureDirectoryExists($root);
        $originalPublicPath = public_path();
        $this->actingAs(User::factory()->create());
        Department::create(['name' => 'Medicine', 'is_active' => true]);
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aoykAAAAASUVORK5CYII=');
        try {
            $this->app->usePublicPath($root);
            $this->post(route('admin.gallery.store'), ['caption' => 'Connection gallery photo', 'image' => UploadedFile::fake()->createWithContent('gallery.png', $png), 'is_active' => 1])->assertSessionHasNoErrors();
            $this->post(route('admin.doctors.store'), ['name' => 'Dr Uploaded', 'designation' => 'Consultant', 'department' => 'Medicine', 'photo' => UploadedFile::fake()->createWithContent('doctor.png', $png), 'is_active' => 1])->assertSessionHasNoErrors();
            $gallery = Gallery::sole(); $doctor = Doctor::sole();
            $this->assertFileExists($root.'/storage/'.$gallery->image);
            $this->assertFileExists($root.'/'.$doctor->photo);
            $this->app->usePublicPath($originalPublicPath);
            $this->get(route('gallery'))->assertOk()->assertSee('Connection gallery photo')->assertSee(asset('storage/'.$gallery->image));
            $this->get(route('doctors'))->assertOk()->assertSee(asset($doctor->photo));
        } finally {
            $this->app->usePublicPath($originalPublicPath);
            File::deleteDirectory($root);
        }
    }

    public function test_legacy_uploaded_media_route_and_missing_files(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('blogs/connection.png', base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aoykAAAAASUVORK5CYII='));
        $this->get('/media/blogs/connection.png')->assertOk();
        $this->get('/media/blogs/missing.png')->assertNotFound();
        $this->get('/media/private/connection.png')->assertNotFound();
    }
}
