<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateLoanAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\LoanServicingEvent;


class PersistLoanServicingEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'LoanServicingEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new LoanServicingEvent);

        $loanServicingEvent = LoanServicingEvent::create($values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($loanServicingEvent);
        }

        $loanServicingEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
            AssociateLoanAmountAction::class,
    	];
    }
}