<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargebackEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\GuaranteeClaimEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedChargebackEvent;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistShipmentEventAction;

class PersistChargebackEventAction extends PersistShipmentEventAction
{
    public function getKey(): string
    {
        return 'ChargebackEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new ChargebackEvent);
        $attributes = ['seller_order_id' => data_get($list, 'SellerOrderId'),];

        $chargebackEvent = ChargebackEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($chargebackEvent);
        }

        $chargebackEvent->push();

        return $chargebackEvent;
    }

    public function getPersistedEvent()
    {
        return PersistedChargebackEvent::class;
    }
}
