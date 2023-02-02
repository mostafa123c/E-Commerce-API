<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class repostoryserviceprovider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(
           'App\Http\Interfaces\AuthInterface',
           'App\Http\Repositories\AuthRepository'
       );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
