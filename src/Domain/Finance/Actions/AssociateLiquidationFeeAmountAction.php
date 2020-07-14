<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateLiquidationFeeAmountAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'LiquidationFeeAmount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $liquidationFeeAmount = CurrencyAmount::create($values);

        $this->model->liquidationFeeAmount()->associate($liquidationFeeAmount);
    }
}