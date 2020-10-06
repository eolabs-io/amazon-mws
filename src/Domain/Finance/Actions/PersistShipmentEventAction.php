<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedShipmentEvent;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachOrderFeeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachOrderChargeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachShipmentFeeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachShipmentItemListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachDirectPaymentListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachOrderFeeAdjustmentListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachOrderChargeAdjustmentListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachShipmentFeeAdjustmentListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachShipmentItemAdjustmentListAction;

class PersistShipmentEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'ShipmentEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new ShipmentEvent);
        $attributes = ['seller_order_id' => data_get($list, 'SellerOrderId'),];

        $shipmentEvent = ShipmentEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($shipmentEvent);
        }

        $shipmentEvent->push();

        return $shipmentEvent;
    }

    protected function associateActions(): array
    {
        return [
            AttachOrderChargeListAction::class,
            AttachOrderChargeAdjustmentListAction::class,
            AttachShipmentFeeListAction::class,
            AttachShipmentFeeAdjustmentListAction::class,
            AttachOrderFeeListAction::class,
            AttachOrderFeeAdjustmentListAction::class,
            AttachDirectPaymentListAction::class,
            AttachShipmentItemListAction::class,
            AttachShipmentItemAdjustmentListAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedShipmentEvent::class;
    }
}
