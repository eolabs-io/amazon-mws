<?php

namespace EolabsIo\AmazonMws\Domain\Sellers\Providers;

use EolabsIo\AmazonMws\Domain\Sellers\Events\FetchListMarketplaceParticipations;
use EolabsIo\AmazonMws\Domain\Sellers\Listeners\FetchListMarketplaceParticipationsListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        FetchListMarketplaceParticipations::class => [
            FetchListMarketplaceParticipationsListener::class,
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