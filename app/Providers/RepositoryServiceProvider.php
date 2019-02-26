<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\CartRepository;
use App\Repositories\CartRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CartRepositoryInterface::class,
            CartRepository::class
        );
    }
}