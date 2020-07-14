<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateTaxTypeSGSTAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'TaxTypeSGST';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $taxTypeSGST = CurrencyAmount::create($values);

        $this->model->taxTypeSGST()->associate($taxTypeSGST);
    }
}