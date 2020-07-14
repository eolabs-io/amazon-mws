<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateBaseTaxAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'BaseTax';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $baseTax = CurrencyAmount::create($values);

        $this->model->baseTax()->associate($baseTax);
    }
}