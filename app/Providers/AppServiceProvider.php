<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function($view) {

            $users = \App\Models\User::latest()->get();
            $view->with('users', $users);
          });
          
          // view()->composer('*', function($view) {

          //   $branches = \App\Models\Branch::latest()->get();
          //   $view->with('branches', $branches);
          // });
          
          view()->composer('admin.dashboard.manager', function($view) {

            $usersBranch = \App\Models\User::where('branch_id', Auth::user()->branch_id)->latest()->get();
            $view->with('usersBranch', $usersBranch);
          });
    }
}
