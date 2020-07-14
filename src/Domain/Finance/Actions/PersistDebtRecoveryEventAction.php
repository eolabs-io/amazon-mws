<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateOverPaymentCreditAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateRecoveryAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachChargeInstrumentListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachDebtRecoveryItemListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryEvent;


class PersistDebtRecoveryEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'DebtRecoveryEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new DebtRecoveryEvent);

        $debtRecoveryEvent = DebtRecoveryEvent::create($values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($debtRecoveryEvent);
        }

        $debtRecoveryEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
            AssociateRecoveryAmountAction::class,
            AssociateOverPaymentCreditAction::class,
    		AttachDebtRecoveryItemListAction::class,
    		AttachChargeInstrumentListAction::class,
    	];
    }
}