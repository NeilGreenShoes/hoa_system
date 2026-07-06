<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\AppConfig;

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
        $path = base_path('routes/Breadcrumbs.php');

        if (!empty($path) && file_exists($path)) {
            require_once $path;
        }

        $config = AppConfig::first();

        View::share('config', $config);
        
        View::composer('components.admin', function ($view) {
            $view->with('appConfig', AppConfig::first());
        });
    }
}
