<?php

namespace EolabsIo\AmazonMws;

use EolabsIo\AmazonMws\Domain\Inventory\Command\InventoryCommand;
use EolabsIo\AmazonMws\Domain\Inventory\InventoryList;
use EolabsIo\AmazonMws\Domain\Inventory\Providers\EventServiceProvider as InventoryEventServiceProvider;
use EolabsIo\AmazonMws\Domain\Inventory\ServiceStatus as InventoryServiceStatus;
use EolabsIo\AmazonMws\Domain\Orders\Command\OrdersCommand;
use EolabsIo\AmazonMws\Domain\Orders\ListOrderItems;
use EolabsIo\AmazonMws\Domain\Orders\ListOrders;
use EolabsIo\AmazonMws\Domain\Orders\Providers\EventServiceProvider as OrdersEventServiceProvider;
use Illuminate\Support\ServiceProvider;

class AmazonMwsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'amazon-mws');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'amazon-mws');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('amazon-mws.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/amazon-mws'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/amazon-mws'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/amazon-mws'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                OrdersCommand::class,
                InventoryCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'amazon-mws');

        $this->app->register(InventoryEventServiceProvider::class);
        $this->app->register(OrdersEventServiceProvider::class);
        
        // Register the main class to use with the facade
        $this->app->singleton('inventory-list', function () {
            return new InventoryList;
        });

        $this->app->singleton('inventory-service-status', function () {
            return new InventoryServiceStatus;
        });

        $this->app->singleton('list-orders', function () {
            return new ListOrders;
        });
        
        $this->app->singleton('list-order-items', function () {
            return new ListOrderItems;
        });
    }
}
