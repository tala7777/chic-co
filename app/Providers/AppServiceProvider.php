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
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        // Ensure session is initialized for guest users (data will be saved by middleware)
        if (!app()->runningInConsole() && !session()->has('active')) {
            session()->put('active', true);
        }
    }
}
