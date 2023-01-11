<?php

namespace Webdecero\Webcms;

use RuntimeException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

use Laravel\Passport\Passport;

use Webdecero\Webcms\Commands\SetupAdmin;
use Webdecero\Webcms\Commands\SetupInstall;
use Webdecero\Webcms\Models\Passport\AuthCode;
use Webdecero\Webcms\Models\Passport\Client;
use Webdecero\Webcms\Models\Passport\PersonalAccessClient;
use Webdecero\Webcms\Models\Passport\Token;
use Webdecero\Webcms\Models\Passport\TokenRepository;
use Webdecero\Webcms\Models\Passport\ClientCommand;

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

        //Passport::routes();

        Passport::tokensCan([
            'admin' => 'Acceso limitado a todas las funciones',
        ]);

        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
        Passport::personalAccessTokensExpireIn(now()->addWeeks(1));

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {

        $this->mergeConfigFrom($this->configCMS, 'webdecero/cms/config.php');

        Passport::ignoreMigrations();

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Laravel\Passport\TokenRepository', TokenRepository::class);
        $loader->alias('Laravel\Passport\Console\ClientCommand', ClientCommand::class);
    }

    private function bootCommands() {

        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupAdmin::class,
                SetupInstall::class,
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
