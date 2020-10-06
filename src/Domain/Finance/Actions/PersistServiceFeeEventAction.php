<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceFeeEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachFeeListAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedServiceFeeEvent;

class PersistServiceFeeEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'ServiceFeeEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new ServiceFeeEvent);
        $attributes = ['amazon_order_id' => data_get($list, 'AmazonOrderId'),];

        $serviceFeeEvent = ServiceFeeEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($serviceFeeEvent);
        }

        $serviceFeeEvent->push();

        return $serviceFeeEvent;
    }

    protected function associateActions(): array
    {
        return [
            AttachFeeListAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedServiceFeeEvent::class;
    }
}
