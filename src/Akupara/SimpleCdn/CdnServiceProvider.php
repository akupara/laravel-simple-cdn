<?php

namespace App\Providers;

use App\Services\Cdn;
use Illuminate\Support\ServiceProvider;

class CdnServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        $this->handleConfigs();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cdn', function($app) {
            return new Cdn($app['config']['cdn.enable'], $app['config']['cdn.url']);
        });
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/../config/cdn.php';

        $this->publishes([$configPath => config_path('cdn.php')]);

        $this->mergeConfigFrom($configPath, 'cdn');
    }
}
