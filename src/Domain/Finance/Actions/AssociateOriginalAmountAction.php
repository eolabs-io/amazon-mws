<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateOriginalAmountAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'OriginalAmount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $originalAmount = CurrencyAmount::create($values);

        $this->model->originalAmount()->associate($originalAmount);
    }
}