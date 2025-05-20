<?php

namespace App\Providers;

use App\Models\SiteInfo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Share site_info function with all views
        View::composer('*', function ($view) {
            $view->with('site_info', function ($key, $default = null) {
                return SiteInfo::getValue($key, $default);
            });
        });
    }
}
