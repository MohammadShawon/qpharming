<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class PermissionsServiceProvider extends ServiceProvider
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
        /*
         * Extract all the permission and check the permission
         * user pass the request
         * */

        Permission::get()->map(function ($permission){
            
            Gate::define($permission->name,function ($user) use ($permission){
               return $user->hasPermissionTo($permission);
            });
        });

        /*
         * Define Blade directive for role
         * */

        Blade::directive('role', function ($role){
           return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });

        Blade::directive('endrole', function ($role){
           return "<?php endif; ?>";
        });
    }
}
