<?php

namespace Cpkm\Print;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Blade;

class PrintServiceProvider extends ServiceProvider
{
    protected $events = [
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->mergeConfigFrom(__DIR__.'/../config/print.php', 'print');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php','print');
        $this->loadViewsFrom(__DIR__.'/../resources/views/print', 'print');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'print');
        $this->loadMigrationsFrom(__DIR__ .'/../database/migrations');

        $this->publishes([
            __DIR__.'/../resources/views/print' => resource_path('views/vendor/print'),
        ], 'print-views');

        $this->publishes([
            __DIR__.'/../lang' => lang_path('vendor/print'),
        ], 'print-translations');

        $this->publishes([
            __DIR__.'/../config/print.php' => config_path('print.php'),
        ], 'print-config');
        
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'print-migrations');

        $this->publishes([
            __DIR__.'/../public' => public_path(),
        ], 'print-public');
        
        Blade::componentNamespace('Cpkm\\Print\\View\\Components\\Backend', 'print');
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
