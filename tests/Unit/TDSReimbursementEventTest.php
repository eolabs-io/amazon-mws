<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\TDSReimbursementEvent;

class TDSReimbursementEventTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TDSReimbursementEvent::class;
    }

    /** @test */
    public function it_has_reimbursedAmount_relationship()
    {
        $tdsReimbursementEvent = TDSReimbursementEvent::factory()->create();
        $reimbursedAmount = CurrencyAmount::factory()->create();

        $tdsReimbursementEvent->reimbursedAmount()->associate($reimbursedAmount);

        $this->assertArraysEqual($reimbursedAmount->toArray(), $tdsReimbursementEvent->reimbursedAmount->toArray());
    }
}
