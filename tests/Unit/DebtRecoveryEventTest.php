<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeInstrument;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryItem;

class DebtRecoveryEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return DebtRecoveryEvent::class;
    }

    /** @test */
    public function it_has_recoveryAmount_relationship()
    {
        $debtRecoveryEvent = factory(DebtRecoveryEvent::class)->create(['recovery_amount_id' => null]);
        $recoveryAmount = factory(CurrencyAmount::class)->create();

        $debtRecoveryEvent->recoveryAmount()->associate($recoveryAmount);

        $this->assertArraysEqual($recoveryAmount->toArray(), $debtRecoveryEvent->recoveryAmount->toArray());
    }

    /** @test */
    public function it_has_overPaymentCredit_relationship()
    {
        $debtRecoveryEvent = factory(DebtRecoveryEvent::class)->create(['over_payment_credit_id' => null]);
        $overPaymentCredit = factory(CurrencyAmount::class)->create();

        $debtRecoveryEvent->overPaymentCredit()->associate($overPaymentCredit);

        $this->assertArraysEqual($overPaymentCredit->toArray(), $debtRecoveryEvent->overPaymentCredit->toArray());
    }

    /** @test */
    public function it_has_debtRecoveryItemList_relationship()
    {
        $debtRecoveryEvent = factory(DebtRecoveryEvent::class)->create();
        $debtRecoveryItemList = factory(DebtRecoveryItem::class, 3)->create();

        $debtRecoveryEvent->debtRecoveryItemList()->toggle($debtRecoveryItemList);

        $this->assertArraysEqual($debtRecoveryItemList->toArray(), 
                                 $debtRecoveryEvent->debtRecoveryItemList->toArray());
    }

    /** @test */
    public function it_has_chargeInstrumentList_relationship()
    {
        $debtRecoveryEvent = factory(DebtRecoveryEvent::class)->create();
        $chargeInstrumentList = factory(ChargeInstrument::class, 3)->create();

        $debtRecoveryEvent->chargeInstrumentList()->toggle($chargeInstrumentList);

        $this->assertArraysEqual($chargeInstrumentList->toArray(), 
                                 $debtRecoveryEvent->chargeInstrumentList->toArray());
    }
}
