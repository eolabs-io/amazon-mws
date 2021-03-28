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
        $debtRecoveryEvent = DebtRecoveryEvent::factory()->create(['recovery_amount_id' => null]);
        $recoveryAmount = CurrencyAmount::factory()->create();

        $debtRecoveryEvent->recoveryAmount()->associate($recoveryAmount);

        $this->assertArraysEqual($recoveryAmount->toArray(), $debtRecoveryEvent->recoveryAmount->toArray());
    }

    /** @test */
    public function it_has_overPaymentCredit_relationship()
    {
        $debtRecoveryEvent = DebtRecoveryEvent::factory()->create(['over_payment_credit_id' => null]);
        $overPaymentCredit = CurrencyAmount::factory()->create();

        $debtRecoveryEvent->overPaymentCredit()->associate($overPaymentCredit);

        $this->assertArraysEqual($overPaymentCredit->toArray(), $debtRecoveryEvent->overPaymentCredit->toArray());
    }

    /** @test */
    public function it_has_debtRecoveryItemList_relationship()
    {
        $debtRecoveryEvent = DebtRecoveryEvent::factory()->create();
        $debtRecoveryItemList = DebtRecoveryItem::factory()->times(3)->create();

        $debtRecoveryEvent->debtRecoveryItemList()->toggle($debtRecoveryItemList);

        $this->assertArraysEqual(
            $debtRecoveryItemList->toArray(),
            $debtRecoveryEvent->debtRecoveryItemList->toArray()
        );
    }

    /** @test */
    public function it_has_chargeInstrumentList_relationship()
    {
        $debtRecoveryEvent = DebtRecoveryEvent::factory()->create();
        $chargeInstrumentList = ChargeInstrument::factory()->times(3)->create();

        $debtRecoveryEvent->chargeInstrumentList()->toggle($chargeInstrumentList);

        $this->assertArraysEqual(
            $chargeInstrumentList->toArray(),
            $debtRecoveryEvent->chargeInstrumentList->toArray()
        );
    }
}
