<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Services\Contracts\ItemService::class, \App\Services\ItemService::class);
        $this->app->bind(\App\Services\Contracts\OrderService::class, \App\Services\OrderService::class);
        $this->app->bind(\App\Services\Contracts\CategoryService::class, \App\Services\CategoryService::class);
        $this->app->bind(\App\Services\Contracts\TypeService::class, \App\Services\TypeService::class);
        //:end-bindings:
    }
}
