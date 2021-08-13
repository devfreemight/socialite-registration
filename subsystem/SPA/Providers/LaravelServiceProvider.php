<?php

namespace Subsystem\SPA\Providers;

use Illuminate\Support\ServiceProvider as ServiceProvider;
use Subsystem\SPA\Impl\SPA;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('spa',function(){
            return new SPA();
        });
    }
}
