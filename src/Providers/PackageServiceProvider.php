<?php

namespace Outl1ne\NovaPermissions\Providers;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslations();
        $this->loadMigrations();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../configs/nova-permissions.php', 'nova-permissions');

        $this->publishes([
            __DIR__ . '/../../configs/nova-permissions.php' => config_path('nova-permissions.php'),
        ], 'config');
    }

    private function loadTranslations()
    {
        $this->loadJSONTranslationsFrom(__DIR__ . '/../../lang', 'nova-permissions');
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->publishes([
            __DIR__ . '/../../database/migrations' => base_path('database/migrations')
        ], 'migrations');
    }
}
