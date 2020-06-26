<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Providers;

use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrderItems;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrders;
use EolabsIo\AmazonMws\Domain\Orders\Events\OrderWasCreated;
use EolabsIo\AmazonMws\Domain\Orders\Events\OrderWasUpdated;
use EolabsIo\AmazonMws\Domain\Orders\Listeners\CreateOrderItems;
use EolabsIo\AmazonMws\Domain\Orders\Listeners\FetchListOrderItemsListener;
use EolabsIo\AmazonMws\Domain\Orders\Listeners\FetchListOrdersListener;
use EolabsIo\AmazonMws\Domain\Orders\Listeners\UpdateOrderItems;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        FetchListOrders::class => [
            FetchListOrdersListener::class,
        ],
        FetchListOrderItems::class => [
            FetchListOrderItemsListener::class,
        ],
        OrderWasCreated::class => [
            CreateOrderItems::class,
        ],
        OrderWasUpdated::class => [
            UpdateOrderItems::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}