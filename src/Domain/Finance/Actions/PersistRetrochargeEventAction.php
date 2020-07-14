<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateBaseTaxAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateShippingTaxAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachRetrochargeTaxWithheldComponentAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\RetrochargeEvent;


class PersistRetrochargeEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'RetrochargeEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new RetrochargeEvent);
		$attributes = ['amazon_order_id' => data_get($list, 'AmazonOrderId'),];

        $retrochargeEvent = RetrochargeEvent::updateOrCreate($attributes, $values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($retrochargeEvent);
        }

        $retrochargeEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
            AssociateBaseTaxAction::class,
            AssociateShippingTaxAction::class,
    		AttachRetrochargeTaxWithheldComponentAction::class,
    	];
    }
}