<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(User $auth)
    {
         
     
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