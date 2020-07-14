<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateTotalAmountAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'TotalAmount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $totalAmount = CurrencyAmount::create($values);

        $this->model->totalAmount()->associate($totalAmount);
    }
}