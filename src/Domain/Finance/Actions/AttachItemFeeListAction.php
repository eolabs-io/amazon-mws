<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateFeeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;


class AttachItemFeeListAction extends BaseAttachAction 
{

    public function getKey(): string
    {
        return 'ItemFeeList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new FeeComponent);
        $feeComponent = FeeComponent::create($values);

        (new AssociateFeeAmountAction($list))->execute($feeComponent);

        $feeComponent->save();

        $this->model->itemFeeList()->attach($feeComponent);
    }

}