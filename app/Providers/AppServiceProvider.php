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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Safely share site settings — wrapped in try/catch so a missing
        // DB table (fresh deploy before migrations) won't crash the whole app.
        try {
            \Illuminate\Support\Facades\View::share(
                'siteSettings',
                \App\Models\SiteSetting::get()
            );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\View::share('siteSettings', new \App\Models\SiteSetting());
        }
    }
}
