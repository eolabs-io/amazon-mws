<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceProviderCreditEvent;


class PersistServiceProviderCreditEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'ServiceProviderCreditEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ServiceProviderCreditEvent);
		$attributes = ['seller_order_id' => data_get($list, 'SellerOrderId'),];

        $serviceProviderCreditEvent = ServiceProviderCreditEvent::updateOrCreate($attributes, $values);
    }

}