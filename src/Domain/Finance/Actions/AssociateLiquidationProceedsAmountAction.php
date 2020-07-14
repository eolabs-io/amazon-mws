<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateLiquidationProceedsAmountAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'LiquidationProceedsAmount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $liquidationProceedsAmount = CurrencyAmount::create($values);

        $this->model->liquidationProceedsAmount()->associate($liquidationProceedsAmount);
    }
}