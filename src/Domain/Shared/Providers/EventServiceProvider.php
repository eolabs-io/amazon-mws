<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Providers;

use EolabsIo\AmazonMws\Domain\Reports\Events\AmazonFulfilledShipmentWasCreated;
use EolabsIo\AmazonMws\Domain\Reports\Events\AmazonFulfilledShipmentWasUpdated;
use EolabsIo\AmazonMws\Domain\Shared\Listeners\CreateOrUpdateBuyer;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        AmazonFulfilledShipmentWasCreated::class => [
            CreateOrUpdateBuyer::class,
        ],
        AmazonFulfilledShipmentWasUpdated::class => [
            CreateOrUpdateBuyer::class,
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
