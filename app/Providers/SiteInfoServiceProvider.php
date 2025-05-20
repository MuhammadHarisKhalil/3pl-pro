<?php

namespace App\Providers;

use App\Models\SiteInfo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class SiteInfoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register a config loader that will load site info from the database
        $this->app->booted(function () {
            $this->loadSiteInfoIntoConfig();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
    
    /**
     * Load site info from the database into the config
     */
    protected function loadSiteInfoIntoConfig(): void
    {
        try {
            $siteInfos = SiteInfo::all();
            
            $configData = [];
            
            foreach ($siteInfos as $info) {
                $configData[$info->group][$info->key] = $info->value;
            }
            
            foreach ($configData as $group => $values) {
                Config::set($group, $values);
            }
        } catch (\Exception $e) {
            // Database might not be set up yet during installation
            // Just continue without loading site info
        }
    }
}