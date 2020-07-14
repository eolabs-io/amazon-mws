<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class AssociateReimbursedAmountAction extends BaseAssociateAction
{

    public function getKey(): string
    {
        return 'ReimbursedAmount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $currencyAmount = CurrencyAmount::create($values);

        $this->model->reimbursedAmount()->associate($currencyAmount);
    }

}