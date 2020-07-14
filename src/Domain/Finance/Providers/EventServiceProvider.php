<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Providers;

use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEventGroups;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Finance\Listeners\FetchListFinancialEventGroupsListener;
use EolabsIo\AmazonMws\Domain\Finance\Listeners\FetchListFinancialEventsListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        FetchListFinancialEventGroups::class => [
            FetchListFinancialEventGroupsListener::class,
        ],
        FetchListFinancialEvents::class => [
            FetchListFinancialEventsListener::class,
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