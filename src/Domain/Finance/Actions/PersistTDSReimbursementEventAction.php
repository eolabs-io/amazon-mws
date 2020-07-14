<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateReimbursedAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\TDSReimbursementEvent;


class PersistTDSReimbursementEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'TDSReimbursementEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new TDSReimbursementEvent);

        $tdsReimbursementEvent = TDSReimbursementEvent::create($values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($tdsReimbursementEvent);
        }

        $tdsReimbursementEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
    		AssociateReimbursedAmountAction::class,
    	];
    }
}