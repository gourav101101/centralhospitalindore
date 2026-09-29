<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        \Illuminate\Support\Facades\RateLimiter::for('admin-login', function (\Illuminate\Http\Request $request) {
            return \Illuminate\Cache\RateLimiting\Limit::perMinute(5)->by($request->ip());
        });
        \Illuminate\Support\Facades\RateLimiter::for('public-forms', function (\Illuminate\Http\Request $request) {
            return \Illuminate\Cache\RateLimiting\Limit::perMinute(5)->by($request->ip());
        });
        if ($this->app->environment('production') || env('APP_ENV') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        try {
            \Illuminate\Support\Facades\View::composer('*', function ($view) {
                if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
                    $siteSettings = \App\Models\SiteSetting::first() ?? new \App\Models\SiteSetting();
                    $view->with('siteSettings', $siteSettings);
                }
            });
        } catch (\Exception $e) {}
    }
}
