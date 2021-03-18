<?php

namespace EolabsIo\AmazonMws\Domain\Products\Listeners;

use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetProductCategoriesForSku;
use EolabsIo\AmazonMws\Domain\Products\Jobs\PerformFetchGetProductCategoriesForSku;

class FetchGetProductCategoriesForSkuListener
{
    public function handle(FetchGetProductCategoriesForSku $event)
    {
        $getProductCategoriesForSku = $event->getProductCategoriesForSku;
        PerformFetchGetProductCategoriesForSku::dispatch($getProductCategoriesForSku)->onQueue('get-product-categories');
    }
}
