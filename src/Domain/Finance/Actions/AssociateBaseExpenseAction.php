<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateBaseExpenseAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'BaseExpense';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $baseExpense = CurrencyAmount::create($values);

        $this->model->baseExpense()->associate($baseExpense);
    }
}