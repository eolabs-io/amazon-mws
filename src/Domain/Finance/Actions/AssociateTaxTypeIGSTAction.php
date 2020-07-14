<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateTaxTypeIGSTAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'TaxTypeIGST';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $taxTypeIGST = CurrencyAmount::create($values);

        $this->model->taxTypeIGST()->associate($taxTypeIGST);
    }
}