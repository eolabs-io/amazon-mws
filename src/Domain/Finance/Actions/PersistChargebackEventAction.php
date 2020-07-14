<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistShipmentEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargebackEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\GuaranteeClaimEvent;


class PersistChargebackEventAction extends PersistShipmentEventAction 
{

    public function getKey(): string
    {
    	return 'ChargebackEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargebackEvent);
		$attributes = ['seller_order_id' => data_get($list, 'SellerOrderId'),];

        $chargebackEvent = ChargebackEvent::updateOrCreate($attributes, $values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($chargebackEvent);
        }

        $chargebackEvent->push();
    }
    
}