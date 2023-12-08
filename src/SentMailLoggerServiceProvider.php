<?php

namespace SolveCase\SentMailLogger;

use Exception;
use Illuminate\Support\ServiceProvider;

class SentMailLoggerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'solvecase');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'solvecase');
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
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/imap.php', 'imap');

        $this->app->register(SentMailLoggerEventProvider::class);

        // Register the service the package provides.
        $this->app->singleton('sentmaillogger', function ($app) {
            return new SentMailLogger;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sentmaillogger'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/sentmaillogger.php' => config_path('sentmaillogger.php'),
        ], 'sentmaillogger.config');

        // Publishing the views.
        /*$this->publishes([
        __DIR__.'/../resources/views' => base_path('resources/views/vendor/solvecase'),
        ], 'sentmaillogger.views');*/

        // Publishing assets.
        /*$this->publishes([
        __DIR__.'/../resources/assets' => public_path('vendor/solvecase'),
        ], 'sentmaillogger.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
        __DIR__.'/../resources/lang' => resource_path('lang/vendor/solvecase'),
        ], 'sentmaillogger.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }

    protected function parseHost(array $config)
    {
        return tap($config['host'], function ($host) {
            if (empty($host)) {
                throw new Exception("IMAP_HOST is missing.");
            }
        });
    }
}
