<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MetarService;
use App\Services\MetarServiceInterface;

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
        $this->app->bind(MetarServiceInterface::class,MetarService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
