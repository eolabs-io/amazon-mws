<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class AdjustmentItemTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return AdjustmentItem::class;
    }

    /** @test */
    public function it_has_perUnitAmount_relationship()
    {
        $adjustmentItem = AdjustmentItem::factory()->create(['per_unit_amount_id' => null]);
        $perUnitAmount = CurrencyAmount::factory()->create();

        $adjustmentItem->perUnitAmount()->associate($perUnitAmount);

        $this->assertArraysEqual($perUnitAmount->toArray(), $adjustmentItem->perUnitAmount->toArray());
    }

    /** @test */
    public function it_has_totalAmount_relationship()
    {
        $adjustmentItem = AdjustmentItem::factory()->create(['total_amount_id' => null]);
        $totalAmount = CurrencyAmount::factory()->create();

        $adjustmentItem->totalAmount()->associate($totalAmount);

        $this->assertArraysEqual($totalAmount->toArray(), $adjustmentItem->totalAmount->toArray());
    }
}
