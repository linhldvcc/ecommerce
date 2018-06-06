<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Product;
use App\Policies\ProductPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPostPolicies();
        //
        Gate::define('admin-role', function($user){
            return $user->isAccessAdmin();
        });
    }

    public function registerPostPolicies()
    {
        Gate::define('create-product', 'App\Policies\ProductPolicy@create');

        Gate::define('update-product', 'App\Policies\ProductPolicy@update');

        Gate::define('delete-product', 'App\Policies\ProductPolicy@delete');
        //Check whether user have ability to this Product base on their Categories Roles.
        Gate::define('touch-product', 'App\Policies\ProductPolicy@touchProduct');
    }
}
