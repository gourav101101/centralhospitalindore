<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminDoctorController;
use App\Http\Controllers\Admin\AdminOperationsController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/media/{folder}/{filename}', [\App\Http\Controllers\PublicMediaController::class, 'legacy'])->where('folder', 'blogs|testimonials')->where('filename', '[A-Za-z0-9._-]+')->name('media.legacy');

Route::get('/sitemap.xml', [\App\Http\Controllers\SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [\App\Http\Controllers\SeoController::class, 'robots'])->name('robots');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/doctors', [PageController::class, 'doctors'])->name('doctors');
Route::get('/doctors/{doctor}', [PageController::class, 'doctorProfile'])->name('doctor.profile');
Route::get('/patient-stories', [PageController::class, 'patientStories'])->name('patient-stories');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::view('/patient-guide', 'patient-guide')->name('patient-guide');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'storeContactMessage'])->middleware('throttle:public-forms')->name('contact.store');
Route::get('/appointment', [PageController::class, 'appointment'])->name('appointment');
Route::post('/appointment', [PageController::class, 'storeAppointment'])->middleware('throttle:public-forms')->name('appointment.store');
Route::get('/videos', [PageController::class, 'videos'])->name('videos');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/resources-downloads', [PageController::class, 'downloads'])->name('downloads');
Route::post('/feedback', [PageController::class, 'storeFeedback'])->middleware('throttle:public-forms')->name('feedback.store');
Route::get('/health-library', [PageController::class, 'healthLibrary'])->name('health-library');
Route::get('/health-library/{blog:slug}', [PageController::class, 'healthArticle'])->name('health-article');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [PageController::class, 'terms'])->name('terms');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->middleware('throttle:admin-login')->name('login.store');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/appointments', [AdminOperationsController::class, 'appointments'])->name('appointments');
        Route::get('/appointments/{appointment}', [AdminOperationsController::class, 'showAppointment'])->name('appointments.show');
        Route::patch('/appointments/{appointment}', [AdminOperationsController::class, 'updateAppointment'])->name('appointments.update');
        Route::get('/enquiries', [AdminOperationsController::class, 'enquiries'])->name('enquiries');
        Route::get('/enquiries/{contactMessage}', [AdminOperationsController::class, 'showEnquiry'])->name('enquiries.show');
        Route::patch('/enquiries/{contactMessage}', [AdminOperationsController::class, 'updateEnquiry'])->name('enquiries.update');
        Route::patch('/enquiries/{contactMessage}/read', [AdminOperationsController::class, 'markEnquiryRead'])->name('enquiries.read');
        Route::get('/directory', [AdminOperationsController::class, 'directory'])->name('directory');
        Route::resource('doctors', AdminDoctorController::class)->except('show');
        Route::resource('departments', AdminDepartmentController::class)->except(['show']);
        Route::resource('blogs', AdminBlogController::class)->except(['show']);
        Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
        Route::resource('videos', \App\Http\Controllers\Admin\AdminVideoController::class)->except('show');
        Route::resource('gallery', AdminGalleryController::class)->except(['show']);
        Route::get('/feedback', [\App\Http\Controllers\Admin\AdminFeedbackController::class, 'index'])->name('feedback.index');
        Route::patch('/feedback/{feedback}', [\App\Http\Controllers\Admin\AdminFeedbackController::class, 'updateStatus'])->name('feedback.update');
        Route::delete('/feedback/{feedback}', [\App\Http\Controllers\Admin\AdminFeedbackController::class, 'destroy'])->name('feedback.destroy');
        Route::get('/brochures', [\App\Http\Controllers\Admin\AdminBrochureController::class, 'index'])->name('brochures.index');
        Route::post('/brochures', [\App\Http\Controllers\Admin\AdminBrochureController::class, 'store'])->name('brochures.store');
        Route::delete('/brochures/{brochure}', [\App\Http\Controllers\Admin\AdminBrochureController::class, 'destroy'])->name('brochures.destroy');
        Route::get('/settings', [AdminSettingController::class, 'edit'])->name('settings');
        Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
