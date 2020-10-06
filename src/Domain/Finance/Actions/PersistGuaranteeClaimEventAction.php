<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Finance\Models\GuaranteeClaimEvent;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistShipmentEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedGuaranteeClaimEvent;

class PersistGuaranteeClaimEventAction extends PersistShipmentEventAction
{
    public function getKey(): string
    {
        return 'GuaranteeClaimEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new GuaranteeClaimEvent);
        $attributes = ['seller_order_id' => data_get($list, 'SellerOrderId'),];

        $guaranteeClaimEvent = GuaranteeClaimEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($guaranteeClaimEvent);
        }

        $guaranteeClaimEvent->push();

        return $guaranteeClaimEvent;
    }

    public function getPersistedEvent()
    {
        return PersistedGuaranteeClaimEvent::class;
    }
}
