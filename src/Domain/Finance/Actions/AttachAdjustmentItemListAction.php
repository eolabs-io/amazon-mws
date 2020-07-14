<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociatePerUnitAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTotalAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryItem;


class AttachAdjustmentItemListAction extends BaseAttachAction 
{
    public function getKey(): string
    {
        return 'AdjustmentItemList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new AdjustmentItem);
        $values['adjustment_event_id'] = $this->model->id;

        $adjustmentItem = AdjustmentItem::create($values);

        foreach($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($adjustmentItem);
        }

        $adjustmentItem->save();
    }

    private function associateActions(): array
    {
        return [
            AssociatePerUnitAmountAction::class,
            AssociateTotalAmountAction::class,
        ];
    }
}