<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateBaseValueAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'BaseValue';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $baseValue = CurrencyAmount::create($values);

        $this->model->baseValue()->associate($baseValue);
    }
}