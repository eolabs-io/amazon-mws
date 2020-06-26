<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Listeners;

use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrderItems;
use EolabsIo\AmazonMws\Domain\Orders\Jobs\PerformFetchListOrderItems;

class FetchListOrderItemsListener
{
    public function handle(FetchListOrderItems $event)
    {
    	$listOrderItems = $event->listOrderItems;
    	PerformFetchListOrderItems::dispatch($listOrderItems)->onQueue('list-order-items');
    }
}