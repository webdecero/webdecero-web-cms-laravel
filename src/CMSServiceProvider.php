<?php

namespace Webdecero\Webcms;

use RuntimeException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Webdecero\Webcms\Commands\SetupAdmin;

//use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class CMSServiceProvider extends ServiceProvider {

    private $configCMS = __DIR__ . '/../config/webdecero/cms/config.php';
    private $configCMSManager = __DIR__ . '/../Manager';
    private $configViews = __DIR__ . '/resources/views';
    private $configHtaccess = __DIR__ . '/../.htaccess';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    
    public function boot() {

        $this->bootConfig();
        $this->bootRoutes();
        $this->bootAssets();
        $this->bootPages();
        $this->bootCommands();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {

        $this->mergeConfigFrom($this->configCMS, 'webdecero/cms/config.php');

    }

    private function bootCommands() {

        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupAdmin::class,
            ]);
        }
    
    }

    private function bootConfig() {

//        Publishes Configuración CMS
//        php artisan vendor:publish --provider="Webdecero\Webcms\CMSServiceProvider" --tag=config

        $this->publishes([
            $this->configCMS => config_path('webdecero/cms/config.php')
                ], 'config');
    }
        
    private function bootRoutes() {

        $this->loadRoutesFrom(__DIR__ . '/routes/api-manager.php');

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        /*$config['namespace'] = 'Webdecero\Conekta\Pages\Controllers';


        Route::group($config, function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/conekta.php');
        });*/
        
    }

    private function bootPages() {
        $this->publishes([
            $this->configViews => resource_path('views'
            )], 'views');
    }

    private function bootAssets() {
        $this->publishes([
            $this->configCMSManager => public_path('manager'),
        ], 'public');
    }
}
