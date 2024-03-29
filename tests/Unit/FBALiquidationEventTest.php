<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FBALiquidationEvent;

class FBALiquidationEventTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return FBALiquidationEvent::class;
    }

    /** @test */
    public function it_has_liquidationProceedsAmount_relationship()
    {
        $fbaLiquidationEvent = FBALiquidationEvent::factory()->create(['liquidation_proceeds_amount_id' => null]);
        $liquidationProceedsAmount = CurrencyAmount::factory()->create();

        $fbaLiquidationEvent->liquidationProceedsAmount()->associate($liquidationProceedsAmount);

        $this->assertArraysEqual($liquidationProceedsAmount->toArray(), $fbaLiquidationEvent->liquidationProceedsAmount->toArray());
    }

    /** @test */
    public function it_has_liquidationFeeAmount_relationship()
    {
        $fbaLiquidationEvent = FBALiquidationEvent::factory()->create(['liquidation_fee_amount_id' => null]);
        $liquidationFeeAmount = CurrencyAmount::factory()->create();

        $fbaLiquidationEvent->liquidationFeeAmount()->associate($liquidationFeeAmount);

        $this->assertArraysEqual($liquidationFeeAmount->toArray(), $fbaLiquidationEvent->liquidationFeeAmount->toArray());
    }
}
