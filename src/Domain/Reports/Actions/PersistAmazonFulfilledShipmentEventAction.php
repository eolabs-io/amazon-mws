<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;

class PersistAmazonFulfilledShipmentEventAction extends BasePersistAction
{
    public function getKey(): string
    {
        return 'RefundEventList';
    }

    protected function createItem($list): Model
    {
        $values = []; //$this->getFormatedAttributes($list, new AmazonFulfilledShipment);
        $attributes = ['seller_order_id' => data_get($list, 'SellerOrderId'),];

        $amazonFulfilledShipment = AmazonFulfilledShipment::updateOrCreate($attributes, $values);


        return $amazonFulfilledShipment;
    }

    public function getPersistedEvent()
    {
        return PersistedAmazonFulfilledShipmentEvent::class;
    }
}
