<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateCostOfPointsReturnedAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'CostOfPointsReturned';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $currencyAmount = CurrencyAmount::create($values);

        $this->model->costOfPointsReturned()->associate($currencyAmount);
    }
}