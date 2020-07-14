<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateTransactionValueAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'TransactionValue';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $transactionValue = CurrencyAmount::create($values);

        $this->model->transactionValue()->associate($transactionValue);
    }
}