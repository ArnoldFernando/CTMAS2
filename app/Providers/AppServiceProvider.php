<?php

namespace App\Providers;

use Carbon\Carbon;
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
    public function boot()
    {
        // if (app()->environment('local')) {
        //     // Set fake date for local development
        //     Carbon::setTestNow(Carbon::create(2024, 10, 20));
        // }
    }
}
