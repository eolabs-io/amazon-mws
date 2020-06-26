<?php

namespace EolabsIo\AmazonMws\Domain\Inventory\Providers;

use EolabsIo\AmazonMws\Domain\Inventory\Events\FetchInventoryList;
use EolabsIo\AmazonMws\Domain\Inventory\Listeners\FetchInventoryListListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        FetchInventoryList::class => [
            FetchInventoryListListener::class,
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