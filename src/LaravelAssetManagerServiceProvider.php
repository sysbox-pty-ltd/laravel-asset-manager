<?php

namespace Sysbox\LaravelAssetManager;

use Illuminate\Support\ServiceProvider;

class LaravelAssetManagerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sysbox');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'sysbox');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelassetmanager.php', 'LaravelAssetManager');

        // Register the service the package provides.
        $this->app->singleton('LaravelAssetManager', function ($app) {
            return new LaravelAssetManager;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['LaravelAssetManager'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravelassetmanager.php' => config_path('laravelassetmanager.php'),
        ], 'LaravelAssetManager.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/sysbox'),
        ], 'laravelassetmanager.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/sysbox'),
        ], 'laravelassetmanager.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/sysbox'),
        ], 'laravelassetmanager.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
