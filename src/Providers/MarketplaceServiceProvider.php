<?php

namespace Sajadsdi\Marketplace\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Sajadsdi\Marketplace\Console\InstallCommand;
use Sajadsdi\Marketplace\Console\PublishCommand;
use Sajadsdi\Marketplace\Http\Middleware\Authenticated;
use Sajadsdi\Marketplace\Http\Middleware\UnAuthenticated;
use Sajadsdi\Marketplace\Repository\Product\ProductPhotoRepositoryInterface;
use Sajadsdi\Marketplace\Repository\Product\ProductRepositoryInterface;
use Sajadsdi\Marketplace\Repository\Order\OrderRepositoryInterface;
use Sajadsdi\Marketplace\Repository\User\UserRepositoryInterface;
use Sajadsdi\Marketplace\Repository\product\ProductPhotoRepository;
use Sajadsdi\Marketplace\Repository\Product\ProductRepository;
use Sajadsdi\Marketplace\Repository\Order\OrderRepository;
use Sajadsdi\Marketplace\Repository\User\UserRepository;


class MarketplaceServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->bindAll();
    }

    public function boot(Router $router): void
    {
        if ($this->app->runningInConsole()) {
            $this->configurePublishing();
            $this->migrationPublishing();
            $this->viewPublishing();
            $this->routePublishing();
            $this->registerCommands();
        }

        $this->setAuthConfig();
        $this->setMiddlewareAliases($router);
        $this->setPolicies();
    }

    private function bindAll(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductPhotoRepositoryInterface::class, ProductPhotoRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    private function setAuthConfig()
    {
        config(['auth.defaults.guard' => 'api']);

        config([
            'auth.guards.api' => [
                'driver'   => 'sanctum',
                'provider' => 'users',
            ]
        ]);
    }

    /**
     * @param Router $router
     * @return void
     */
    private function setMiddlewareAliases(Router $router): void
    {
        $router->aliasMiddleware('auth.api', Authenticated::class);
        $router->aliasMiddleware('guest.api', UnAuthenticated::class);
    }

    private function setPolicies(): void
    {
        foreach (config('marketplace.policies', []) as $ability => $policy) {
            Gate::define($ability, $policy);
        }
    }

    private function viewPublishing()
    {
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views'),], 'marketplace-view');
    }

    private function routePublishing()
    {
        $this->publishes([__DIR__ . '/../../routes' => base_path('routes'),], 'marketplace-route');
    }

    private function configurePublishing()
    {
        $this->publishes([__DIR__ . '/../../config' => config_path()], 'marketplace-configure');
    }

    private function migrationPublishing()
    {
        $this->publishes([__DIR__ . '/../../database/migrations' => database_path('migrations')], 'marketplace-migration');
    }

    private function registerCommands()
    {
        $this->commands([
            PublishCommand::class,
            InstallCommand::class,
        ]);
    }

}
