<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateFeeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;


class AttachItemFeeListAdjustmentAction extends BaseAttachAction 
{

    public function getKey(): string
    {
        return 'ItemFeeAdjustmentList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new FeeComponent);
        $feeComponent = FeeComponent::create($values);

        (new AssociateFeeAmountAction($list))->execute($feeComponent);

        $feeComponent->save();

        $this->model->itemFeeAdjustmentList()->attach($feeComponent);
    }

}