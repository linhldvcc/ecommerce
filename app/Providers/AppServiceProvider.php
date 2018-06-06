<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        Schema::defaultStringLength(191);

        $gate->define('permission', function ($user, $permissions) {
            if (is_array($permissions)) {
                $permit = true;
                foreach ($permissions as $permission) {
                    if ($user->hasDefinePrivilege($permission)) {
                        return true;
                    }

                    $permit = $permit && $user->hasDefinePrivilege($permission);
                }

                return $permit;
            }

            return $user->hasDefinePrivilege($permissions);
        });

        //Create directive to show Price
        Blade::directive('money', function ($money) {
            return "<?php echo number_format($money); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
