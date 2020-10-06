<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachFeeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedPayWithAmazonEvent;

class PersistPayWithAmazonEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'PayWithAmazonEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new PayWithAmazonEvent);
        $attributes = ['seller_order_id' => data_get($list, 'SellerOrderId'),];

        $payWithAmazonEvent = PayWithAmazonEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($payWithAmazonEvent);
        }

        $payWithAmazonEvent->push();

        return $payWithAmazonEvent;
    }

    protected function associateActions(): array
    {
        return [
            AssociateChargeAction::class,
            AttachFeeListAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedPayWithAmazonEvent::class;
    }
}
