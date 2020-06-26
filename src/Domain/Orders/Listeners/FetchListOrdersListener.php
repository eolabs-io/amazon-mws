<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Listeners;

use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrders;
use EolabsIo\AmazonMws\Domain\Orders\Jobs\PerformFetchListOrders;

class FetchListOrdersListener
{
    public function handle(FetchListOrders $event)
    {
    	$listOrders = $event->listOrders;
    	PerformFetchListOrders::dispatch($listOrders)->onQueue('list-orders');
    }
}