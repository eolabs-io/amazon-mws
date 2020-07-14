<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachFeeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceFeeEvent;


class PersistServiceFeeEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'ServiceFeeEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ServiceFeeEvent);
		$attributes = ['amazon_order_id' => data_get($list, 'AmazonOrderId'),];

        $serviceFeeEvent = ServiceFeeEvent::updateOrCreate($attributes, $values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($serviceFeeEvent);
        }

        $serviceFeeEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
            AttachFeeListAction::class,
    	];
    }
}