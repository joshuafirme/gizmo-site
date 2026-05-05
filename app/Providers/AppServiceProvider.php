<?php

namespace App\Providers;

use App\Models\SystemSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('settings', function () {
            return SystemSetting::latest()->first() ?? new SystemSetting();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Prevent database queries from breaking terminal commands (like migrations)
        if (!app()->runningInConsole()) {
            if (Schema::hasTable('system_settings')) {
                // Share the settings globally with ALL Blade views
                View::share('settings', app('settings'));
            }
        }

        if (Schema::hasTable('product_categories')) {
            $navCategories = ProductCategory::with(['subcategories' => function($q) {
                $q->where('is_active', true);
            }])->where('is_active', true)->get();
            
            View::share('navCategories', $navCategories);
        }
    }
}
