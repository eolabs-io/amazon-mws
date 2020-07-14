<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateRecoveryAmountAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'RecoveryAmount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $recoveryAmount = CurrencyAmount::create($values);

        $this->model->recoveryAmount()->associate($recoveryAmount);
    }
}