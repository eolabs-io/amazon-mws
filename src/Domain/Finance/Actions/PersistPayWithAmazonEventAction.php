<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachFeeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent;


class PersistPayWithAmazonEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'PayWithAmazonEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new PayWithAmazonEvent);
		$attributes = ['seller_order_id' => data_get($list, 'SellerOrderId'),];

        $payWithAmazonEvent = PayWithAmazonEvent::updateOrCreate($attributes, $values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($payWithAmazonEvent);
        }

        $payWithAmazonEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
    		AssociateChargeAction::class,
        	AttachFeeListAction::class,
    	];
    }
}