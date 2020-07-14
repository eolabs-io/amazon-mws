<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryEvent;


trait AssertsDebtRecoveryEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryEvent */
    public $debtRecoveryEvent;

    public function assertDebtRecoveryEventResponse()
    {
        $debtRecoveryEvent = DebtRecoveryEvent::first();

        $this->assertSeesDebtRecoveryEvent($debtRecoveryEvent);
    }

    public function assertSeesDebtRecoveryEvent($event)
    {
        $this->debtRecoveryEvent = $event;

        $this->assertEquals($this->debtRecoveryEvent->debt_recovery_type, "DebtPayment");
        $this->assertEquals($this->debtRecoveryEvent->recoveryAmount->currency_amount, 4.21);
        $this->assertEquals($this->debtRecoveryEvent->overPaymentCredit->currency_amount, 0.41);

        $this->debtRecoveryEvent = null;
    }

}