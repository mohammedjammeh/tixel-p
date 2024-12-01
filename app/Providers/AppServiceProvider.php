<?php

namespace App\Providers;

use App\Wrappers\Contracts\TakeawayInterface;
use App\Wrappers\TakeawayAPI;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TakeawayInterface::class, TakeawayAPI::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
