<?php

namespace EolabsIo\AmazonMws\Domain\Products\Listeners;

use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetMatchingProduct;
use EolabsIo\AmazonMws\Domain\Products\Jobs\PerformFetchGetMatchingProduct;

class FetchGetMatchingProductListener
{
    public function handle(FetchGetMatchingProduct $event)
    {
    	$getMatchingProduct = $event->getMatchingProduct;
    	PerformFetchGetMatchingProduct::dispatch($getMatchingProduct)->onQueue('get-matching-products');
    }
}