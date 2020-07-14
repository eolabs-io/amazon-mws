<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class AdjustmentEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return AdjustmentEvent::class;
    }

    /** @test */
    public function it_has_adjustmentAmount_relationship()
    {
        $adjustmentEvent = factory(AdjustmentEvent::class)->create(['adjustment_amount_id' => null]);
        $adjustmentAmount = factory(CurrencyAmount::class)->create();

        $adjustmentEvent->adjustmentAmount()->associate($adjustmentAmount);

        $this->assertArraysEqual($adjustmentAmount->toArray(), $adjustmentEvent->adjustmentAmount->toArray());
    }

    public function it_has_adjustmentItemList_relationship()
    {
        $adjustmentEvent = factory(AdjustmentEvent::class)->create();
        $adjustmentItemList = factory(AdjustmentItem::class)->create(['adjustment_event_id' => $adjustmentEvent->id]);

        $this->assertArraysEqual($adjustmentItemList->toArray(), $adjustmentEvent->adjustmentItemList->toArray());
    }

}
