<?php

namespace Laravelless\Lessphp;

use Illuminate\Support\ServiceProvider;

class LessphpServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    protected $defer = false;

    public function boot()
    {
        $this->app['Lessphp'] = $this->app->share(function($app) {
            return new Lessphp($app['config']);
        });
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('Lessphp.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require __DIR__.'/../vendor/leafo/lessphp/lessc.inc.php';
    }

    public function provides()
    {
        return array('Lessphp');
    }
}
