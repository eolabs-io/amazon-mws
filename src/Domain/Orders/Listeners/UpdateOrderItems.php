<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Listeners;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrderItems;
use EolabsIo\AmazonMws\Domain\Orders\Events\OrderWasUpdated;
use EolabsIo\AmazonMws\Support\Facades\ListOrderItems;

class UpdateOrderItems
{
    public function handle(OrderWasUpdated $event)
    {
        $amazonOrderId = $event->order->amazon_order_id;
        $store_id = $event->order->store_id;

	    $store = Store::find($store_id);
		$listOrderItems = ListOrderItems::withStore($store)->withAmazonOrderId($amazonOrderId);  
	    FetchListOrderItems::dispatch($listOrderItems);
    }
}