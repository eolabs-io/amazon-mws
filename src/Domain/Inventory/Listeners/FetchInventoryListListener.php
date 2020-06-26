<?php

namespace EolabsIo\AmazonMws\Domain\Inventory\Listeners;

use EolabsIo\AmazonMws\Domain\Inventory\Events\FetchInventoryList;
use EolabsIo\AmazonMws\Domain\Inventory\Jobs\PerformFetchInventoryList;

class FetchInventoryListListener
{
    public function handle(FetchInventoryList $event)
    {
    	$inventoryList = $event->inventoryList;
    	PerformFetchInventoryList::dispatch($inventoryList);
    }
}