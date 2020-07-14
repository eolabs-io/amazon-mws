<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateReimbursedAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachSAFETReimbursementItemListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;


class PersistSAFETReimbursementEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'SAFETReimbursementEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new SafeTReimbursementEvent);

        $safeTReimbursementEvent = SafeTReimbursementEvent::create($values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($safeTReimbursementEvent);
        }

        $safeTReimbursementEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
    		AssociateReimbursedAmountAction::class,
            AttachSAFETReimbursementItemListAction::class,
    	];
    }
}