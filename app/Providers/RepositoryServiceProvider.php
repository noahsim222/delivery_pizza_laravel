<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\Contracts\CategoryRepository::class, \App\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CategoryTranslationsRepository::class, \App\Repositories\CategoryTranslationsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ItemRepository::class, \App\Repositories\ItemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ItemTranslationsRepository::class, \App\Repositories\ItemTranslationsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CurrencyRepository::class, \App\Repositories\CurrencyRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\DeliveryInfoRepository::class, \App\Repositories\DeliveryInfoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\OrderRepository::class, \App\Repositories\OrderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\OrderItemsRepository::class, \App\Repositories\OrderItemsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\TypeRepository::class, \App\Repositories\TypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\TypeTranslationsRepository::class, \App\Repositories\TypeTranslationsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\LanguageRepository::class, \App\Repositories\LanguageRepositoryEloquent::class);
        //:end-bindings:
    }
}
