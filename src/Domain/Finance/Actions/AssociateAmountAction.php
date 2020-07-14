<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateAmountAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'Amount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $amount = CurrencyAmount::create($values);

        $this->model->amount()->associate($amount);
    }
}