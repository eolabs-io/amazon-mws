<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateLoanAmountAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'LoanAmount';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $loanAmount = CurrencyAmount::create($values);

        $this->model->loanAmount()->associate($loanAmount);
    }
}