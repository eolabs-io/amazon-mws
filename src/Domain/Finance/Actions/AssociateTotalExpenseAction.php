<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateTotalExpenseAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'TotalExpense';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $totalExpense = CurrencyAmount::create($values);

        $this->model->totalExpense()->associate($totalExpense);
    }
}