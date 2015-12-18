<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Base', function()
        {
            return new \App\Http\Controllers\Providers\BaseServiceProviders;
        });
    }

    public function provides()
    {
        return ['Base'];
    }
}
