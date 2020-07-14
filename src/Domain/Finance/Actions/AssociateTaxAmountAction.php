<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateTaxAmountAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'TaxAmount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $taxAmount = CurrencyAmount::create($values);

        $this->model->taxAmount()->associate($taxAmount);
    }
}