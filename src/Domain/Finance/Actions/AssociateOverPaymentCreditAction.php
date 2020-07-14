<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateOverPaymentCreditAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'OverPaymentCredit';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $recoveryAmount = CurrencyAmount::create($values);

        $this->model->overPaymentCredit()->associate($recoveryAmount);
    }
}