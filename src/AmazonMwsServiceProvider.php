<?php

namespace EolabsIo\AmazonMws;

use Illuminate\Support\ServiceProvider;
use EolabsIo\AmazonMws\Domain\Orders\ListOrders;
use EolabsIo\AmazonMws\Domain\Orders\ListOrderItems;
use EolabsIo\AmazonMws\Domain\Inventory\InventoryList;
use EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating;
use EolabsIo\AmazonMws\Domain\Finance\ListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Products\GetMatchingProduct;
use EolabsIo\AmazonMws\Domain\Orders\Command\OrdersCommand;
use EolabsIo\AmazonMws\Domain\Sellers\Command\SellerCommand;
use EolabsIo\AmazonMws\Domain\Products\Command\ProductCommand;
use EolabsIo\AmazonMws\Domain\Finance\ListFinancialEventGroups;
use EolabsIo\AmazonMws\Domain\Orders\Command\OrderItemsCommand;
use EolabsIo\AmazonMws\Domain\Inventory\Command\InventoryCommand;
use EolabsIo\AmazonMws\Domain\Finance\Command\FinancialEventCommand;
use EolabsIo\AmazonMws\Domain\Sellers\ListMarketplaceParticipations;
use EolabsIo\AmazonMws\Domain\Reviews\Command\LogReviewRatingCommand;
use EolabsIo\AmazonMws\Domain\Reviews\Providers\ReviewsServiceProvider;
use EolabsIo\AmazonMws\Domain\Finance\Command\FinancialEventGroupCommand;
use EolabsIo\AmazonMws\Domain\Inventory\ServiceStatus as InventoryServiceStatus;
use EolabsIo\AmazonMws\Domain\Orders\Providers\EventServiceProvider as OrdersEventServiceProvider;
use EolabsIo\AmazonMws\Domain\Finance\Providers\EventServiceProvider as FinanceEventServiceProvider;
use EolabsIo\AmazonMws\Domain\Sellers\Providers\EventServiceProvider as SellersEventServiceProvider;
use EolabsIo\AmazonMws\Domain\Products\Providers\EventServiceProvider as ProductsEventServiceProvider;
use EolabsIo\AmazonMws\Domain\Inventory\Providers\EventServiceProvider as InventoryEventServiceProvider;

class AmazonMwsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadFactoriesFrom(__DIR__.'/../database/factories');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('amazon-mws.php'),
            ], 'config');

            // Registering package commands.
            $this->commands([
                OrdersCommand::class,
                OrderItemsCommand::class,
                InventoryCommand::class,
                FinancialEventCommand::class,
                FinancialEventGroupCommand::class,
                ProductCommand::class,
                LogReviewRatingCommand::class,
                SellerCommand::class,
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
        $this->app->register(FinanceEventServiceProvider::class);
        $this->app->register(ProductsEventServiceProvider::class);
        $this->app->register(ReviewsServiceProvider::class);
        $this->app->register(SellersEventServiceProvider::class);

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

        $this->app->singleton('list-financial-event-groups', function () {
            return new ListFinancialEventGroups;
        });

        $this->app->singleton('list-financial-events', function () {
            return new ListFinancialEvents;
        });

        $this->app->singleton('get-matching-product', function () {
            return new GetMatchingProduct;
        });

        $this->app->singleton('list-marketplace-participations', function () {
            return new ListMarketplaceParticipations;
        });

        $this->app->singleton('get-review-rating', function () {
            return new GetReviewRating;
        });
    }
}
