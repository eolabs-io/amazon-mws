<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceProviderCreditEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class PersistServiceProviderCreditEventAction extends BasePersistAction
{
    use FormatsModelAttributes;
    
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