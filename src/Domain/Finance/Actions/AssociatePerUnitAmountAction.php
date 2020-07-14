<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociatePerUnitAmountAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'PerUnitAmount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $perUnitAmount = CurrencyAmount::create($values);

        $this->model->perUnitAmount()->associate($perUnitAmount);
    }
}