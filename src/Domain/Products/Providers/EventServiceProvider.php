<?php

namespace EolabsIo\AmazonMws\Domain\Products\Providers;

use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetMatchingProduct;
use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetProductCategoriesForSku;
use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetProductCategoriesForAsin;
use EolabsIo\AmazonMws\Domain\Products\Listeners\FetchGetMatchingProductListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use EolabsIo\AmazonMws\Domain\Products\Listeners\FetchGetProductCategoriesForSkuListener;
use EolabsIo\AmazonMws\Domain\Products\Listeners\FetchGetProductCategoriesForAsinListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchGetMatchingProduct::class => [
            FetchGetMatchingProductListener::class,
        ],
        FetchGetProductCategoriesForAsin::class => [
            FetchGetProductCategoriesForAsinListener::class
        ],
        FetchGetProductCategoriesForSku::class => [
            FetchGetProductCategoriesForSkuListener::class
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
