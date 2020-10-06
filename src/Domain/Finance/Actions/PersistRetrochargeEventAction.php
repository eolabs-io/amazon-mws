<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Finance\Models\RetrochargeEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateBaseTaxAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedRetrochargeEvent;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateShippingTaxAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachRetrochargeTaxWithheldComponentAction;

class PersistRetrochargeEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'RetrochargeEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new RetrochargeEvent);
        $attributes = ['amazon_order_id' => data_get($list, 'AmazonOrderId'),];

        $retrochargeEvent = RetrochargeEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($retrochargeEvent);
        }

        $retrochargeEvent->push();

        return $retrochargeEvent;
    }

    protected function associateActions(): array
    {
        return [
            AssociateBaseTaxAction::class,
            AssociateShippingTaxAction::class,
            AttachRetrochargeTaxWithheldComponentAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedRetrochargeEvent::class;
    }
}
