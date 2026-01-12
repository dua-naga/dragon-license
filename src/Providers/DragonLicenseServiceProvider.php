<?php

namespace DuaNaga\DragonLicense\Providers;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use DuaNaga\DragonLicense\Middleware\ActiveSession;
use DuaNaga\DragonLicense\Middleware\CanInstall;
use DuaNaga\DragonLicense\Middleware\CanNext;
use DuaNaga\DragonLicense\Middleware\CanUpdate;
use DuaNaga\DragonLicense\Middleware\IsLicense;

class DragonLicenseServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/dragon-license.php', 'dragon-license'
        );
        
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
    }

    /**
     * Bootstrap the application events.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        // Load views
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'dragon-license');
        
        // Also publish views to vendor folder for customization
        $this->publishes([
            __DIR__.'/../Resources/views' => resource_path('views/vendor/dragon-license'),
        ], 'dragon-license-views');
        
        // Publish config
        $this->publishes([
            __DIR__.'/../Config/dragon-license.php' => config_path('dragon-license.php'),
        ], 'dragon-license-config');
        
        // Register middleware aliases
        $router->aliasMiddleware('is_license', IsLicense::class);
        $router->aliasMiddleware('install', CanInstall::class);
        $router->aliasMiddleware('update', CanUpdate::class);
        $router->aliasMiddleware('nextinstall', CanNext::class);
        $router->aliasMiddleware('active_session', ActiveSession::class);
    }
}
