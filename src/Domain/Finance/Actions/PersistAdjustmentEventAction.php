<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateAdjustmentAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachAdjustmentItemListAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class PersistAdjustmentEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
    	return 'AdjustmentEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new AdjustmentEvent);

        $adjustmentEvent = AdjustmentEvent::create($values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($adjustmentEvent);
        }

        $adjustmentEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
            AssociateAdjustmentAmountAction::class,
            AttachAdjustmentItemListAction::class,
    	];
    }
}