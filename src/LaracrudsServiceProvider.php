<?php

namespace Laracruds;

use Illuminate\Support\ServiceProvider;

class LaracrudsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('laracruds.php')
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
