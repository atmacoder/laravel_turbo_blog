<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Contracts\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fetch the Site Settings object
        view()->composer('*', function(View $view) {
            $settings = \App\Models\Settings::first();
            $view->with('settings', $settings);
        });
    }
}
