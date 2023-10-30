<?php

namespace App\Providers;

use App\Models\Rate;
use App\Observers\RateObserver;
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
        Rate::observe(RateObserver::class);
    }
}
