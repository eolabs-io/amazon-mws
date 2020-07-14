<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistShipmentEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\RefundEvent;


class PersistRefundEventAction extends PersistShipmentEventAction 
{

    public function getKey(): string
    {
    	return 'RefundEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new RefundEvent);
		$attributes = ['seller_order_id' => data_get($list, 'SellerOrderId'),];

        $refundEvent = RefundEvent::updateOrCreate($attributes, $values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($refundEvent);
        }

        $refundEvent->push();
    }
    
}