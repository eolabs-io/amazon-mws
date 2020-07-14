<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateOriginalAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateRecoveryAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryItem;


class AttachDebtRecoveryItemListAction extends BaseAttachAction 
{
    public function getKey(): string
    {
        return 'DebtRecoveryItemList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new DebtRecoveryItem);
        $debtRecoveryItem = DebtRecoveryItem::create($values);

        foreach($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($debtRecoveryItem);
        }

        $debtRecoveryItem->save();

        $this->model->debtRecoveryItemList()->attach($debtRecoveryItem);
    }

    private function associateActions(): array
    {
        return [
            AssociateRecoveryAmountAction::class,
            AssociateOriginalAmountAction::class,
        ];
    }
}