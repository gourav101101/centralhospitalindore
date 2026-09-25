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
