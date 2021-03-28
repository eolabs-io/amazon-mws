<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryItem;

class DebtRecoveryItemTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return DebtRecoveryItem::class;
    }

    /** @test */
    public function it_has_recoveryAmount_relationship()
    {
        $debtRecoveryItem = DebtRecoveryItem::factory()->create(['recovery_amount_id' => null]);
        $recoveryAmount = CurrencyAmount::factory()->create();

        $debtRecoveryItem->recoveryAmount()->associate($recoveryAmount);

        $this->assertArraysEqual($recoveryAmount->toArray(), $debtRecoveryItem->recoveryAmount->toArray());
    }

    /** @test */
    public function it_has_originalAmount_relationship()
    {
        $debtRecoveryItem = DebtRecoveryItem::factory()->create(['original_amount_id' => null]);
        $originalAmount = CurrencyAmount::factory()->create();

        $debtRecoveryItem->originalAmount()->associate($originalAmount);

        $this->assertArraysEqual($originalAmount->toArray(), $debtRecoveryItem->originalAmount->toArray());
    }
}
