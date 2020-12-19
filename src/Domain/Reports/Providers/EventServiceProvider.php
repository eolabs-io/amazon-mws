<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // FetchListFinancialEventGroups::class => [
        //     FetchListFinancialEventGroupsListener::class,
        // ],
        // FetchListFinancialEvents::class => [
        //     FetchListFinancialEventsListener::class,
        // ],
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
