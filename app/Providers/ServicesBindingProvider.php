<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class ServicesBindingProvider extends ServiceProvider
{
    protected $services = [
        \App\Services\Api\Contracts\UserServiceInterface::class => \App\Services\Api\UserService::class,
        \App\Services\Web\Contracts\UserServiceInterface::class => \App\Services\Web\UserService::class,
        \App\Services\Web\Contracts\CategoryServiceInterface::class => \App\Services\Web\CategoryService::class,
        \App\Services\Web\Contracts\ProductServiceInterface::class => \App\Services\Web\ProductService::class,
        \App\Services\Web\Contracts\ProductImageServiceInterface::class => \App\Services\Web\ProductImageService::class,
    ];

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
        foreach ($this->services as $interface => $service) {
            App::bind($interface, $service);
        }
    }
}
