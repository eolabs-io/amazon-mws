<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateTaxExclusiveAmountAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'TaxExclusiveAmount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $taxExclusiveAmount = CurrencyAmount::create($values);

        $this->model->taxExclusiveAmount()->associate($taxExclusiveAmount);
    }
}