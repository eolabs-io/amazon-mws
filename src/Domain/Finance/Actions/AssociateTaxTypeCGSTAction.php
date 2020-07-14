<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateTaxTypeCGSTAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'TaxTypeCGST';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $taxTypeCGST = CurrencyAmount::create($values);

        $this->model->taxTypeCGST()->associate($taxTypeCGST);
    }
}