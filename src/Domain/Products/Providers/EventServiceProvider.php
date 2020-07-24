<?php

namespace EolabsIo\AmazonMws\Domain\Products\Providers;

use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetMatchingProduct;
use EolabsIo\AmazonMws\Domain\Products\Listeners\FetchGetMatchingProductListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        FetchGetMatchingProduct::class => [
            FetchGetMatchingProductListener::class,
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