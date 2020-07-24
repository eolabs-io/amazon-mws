<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateReimbursedAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\TDSReimbursementEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class PersistTDSReimbursementEventAction extends BasePersistAction
{
    use FormatsModelAttributes;
    
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