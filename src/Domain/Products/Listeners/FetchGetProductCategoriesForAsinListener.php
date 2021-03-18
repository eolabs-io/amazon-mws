<?php

namespace EolabsIo\AmazonMws\Domain\Products\Listeners;

use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetProductCategoriesForAsin;
use EolabsIo\AmazonMws\Domain\Products\Jobs\PerformFetchGetProductCategoriesForAsin;

class FetchGetProductCategoriesForAsinListener
{
    public function handle(FetchGetProductCategoriesForAsin $event)
    {
        $getProductCategoriesForAsin = $event->getProductCategoriesForAsin;
        PerformFetchGetProductCategoriesForAsin::dispatch($getProductCategoriesForAsin)->onQueue('get-product-categories');
    }
}
