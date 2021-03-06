<?php

namespace EolabsIo\AmazonMws;

use Illuminate\Support\ServiceProvider;
use EolabsIo\AmazonMws\Domain\Orders\ListOrders;
use EolabsIo\AmazonMws\Domain\Orders\ListOrderItems;
use EolabsIo\AmazonMws\Domain\Reports\GetReportList;
use EolabsIo\AmazonMws\Domain\Reports\RequestReport;
use EolabsIo\AmazonMws\Domain\Inventory\InventoryList;
use EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating;
use EolabsIo\AmazonMws\Domain\Reviews\GetProductReview;
use EolabsIo\AmazonMws\Domain\Finance\ListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Products\GetMatchingProduct;
use EolabsIo\AmazonMws\Domain\Orders\Command\OrdersCommand;
use EolabsIo\AmazonMws\Domain\Reports\CancelReportRequests;
use EolabsIo\AmazonMws\Domain\Reports\GetReportRequestList;
use EolabsIo\AmazonMws\Domain\Reports\GetReportRequestCount;
use EolabsIo\AmazonMws\Domain\Sellers\Command\SellerCommand;
use EolabsIo\AmazonMws\Domain\Products\Command\ProductCommand;
use EolabsIo\AmazonMws\Domain\Finance\ListFinancialEventGroups;
use EolabsIo\AmazonMws\Domain\Orders\Command\OrderItemsCommand;
use EolabsIo\AmazonMws\Domain\Inventory\Command\InventoryCommand;
use EolabsIo\AmazonMws\Domain\Products\GetProductCategoriesForSKU;
use EolabsIo\AmazonMws\Domain\Products\GetProductCategoriesForAsin;
use EolabsIo\AmazonMws\Domain\Reports\Command\RequestReportCommand;
use EolabsIo\AmazonMws\Domain\Finance\Command\FinancialEventCommand;
use EolabsIo\AmazonMws\Domain\Sellers\ListMarketplaceParticipations;
use EolabsIo\AmazonMws\Domain\Reviews\Command\LogReviewRatingCommand;
use EolabsIo\AmazonMws\Domain\Products\Command\ProductCategoryCommand;
use EolabsIo\AmazonMws\Domain\Reviews\Command\GetProductReviewsCommand;
use EolabsIo\AmazonMws\Domain\Reviews\Providers\ReviewsServiceProvider;
use EolabsIo\AmazonMws\Domain\Finance\Command\FinancialEventGroupCommand;
use EolabsIo\AmazonMws\Domain\Inventory\ServiceStatus as InventoryServiceStatus;
use EolabsIo\AmazonMws\Domain\Orders\Providers\EventServiceProvider as OrdersEventServiceProvider;
use EolabsIo\AmazonMws\Domain\Shared\Providers\EventServiceProvider as SharedEventServiceProvider;
use EolabsIo\AmazonMws\Domain\Finance\Providers\EventServiceProvider as FinanceEventServiceProvider;
use EolabsIo\AmazonMws\Domain\Reports\Providers\EventServiceProvider as ReportsEventServiceProvider;
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
        if ($this->app->runningInConsole()) {
            if (AmazonMws::$runsMigrations) {
                $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            }

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations/amazonMws'),
            ], 'amazon-mws-migrations');

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('amazon-mws.php'),
            ], 'amazon-mws-config');

            // Registering package commands.
            $this->commands([
                OrdersCommand::class,
                OrderItemsCommand::class,
                InventoryCommand::class,
                FinancialEventCommand::class,
                FinancialEventGroupCommand::class,
                ProductCommand::class,
                ProductCategoryCommand::class,
                LogReviewRatingCommand::class,
                GetProductReviewsCommand::class,
                SellerCommand::class,
                RequestReportCommand::class,
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
        $this->app->register(ReportsEventServiceProvider::class);
        $this->app->register(SharedEventServiceProvider::class);

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

        $this->app->singleton('get-product-review', function () {
            return new GetProductReview;
        });

        $this->app->singleton('request-report', function () {
            return new RequestReport;
        });

        $this->app->singleton('get-report-request-list', function () {
            return new GetReportRequestList;
        });

        $this->app->singleton('get-report-request-count', function () {
            return new GetReportRequestCount;
        });

        $this->app->singleton('cancel-report-requests', function () {
            return new CancelReportRequests;
        });

        $this->app->singleton('get-report-list', function () {
            return new GetReportList;
        });

        $this->app->singleton('get-product-categories-for-asin', function () {
            return new GetProductCategoriesForAsin;
        });

        $this->app->singleton('get-product-categories-for-sku', function () {
            return new GetProductCategoriesForSKU;
        });
    }
}
