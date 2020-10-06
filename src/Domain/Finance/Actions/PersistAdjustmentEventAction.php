<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedAdjustmentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachAdjustmentItemListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateAdjustmentAmountAction;

class PersistAdjustmentEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'AdjustmentEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new AdjustmentEvent);

        $adjustmentEvent = AdjustmentEvent::create($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($adjustmentEvent);
        }

        $adjustmentEvent->push();

        return $adjustmentEvent;
    }

    protected function associateActions(): array
    {
        return [
            AssociateAdjustmentAmountAction::class,
            AttachAdjustmentItemListAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedAdjustmentEvent::class;
    }
}
