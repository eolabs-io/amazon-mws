<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Finance\Models\RefundEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedRefundEvent;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistShipmentEventAction;

class PersistRefundEventAction extends PersistShipmentEventAction
{
    public function getKey(): string
    {
        return 'RefundEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new RefundEvent);
        $attributes = ['seller_order_id' => data_get($list, 'SellerOrderId'),];

        $refundEvent = RefundEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($refundEvent);
        }

        $refundEvent->push();

        return $refundEvent;
    }

    public function getPersistedEvent()
    {
        return PersistedRefundEvent::class;
    }
}
