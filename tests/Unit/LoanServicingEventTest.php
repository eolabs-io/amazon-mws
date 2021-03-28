<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\LoanServicingEvent;

class LoanServicingEventTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return LoanServicingEvent::class;
    }

    /** @test */
    public function it_has_loanAmount_relationship()
    {
        $loanServicingEvent = LoanServicingEvent::factory()->create(['loan_amount_id' => null]);
        $loanAmount = CurrencyAmount::factory()->create();

        $loanServicingEvent->loanAmount()->associate($loanAmount);

        $this->assertArraysEqual($loanAmount->toArray(), $loanServicingEvent->loanAmount->toArray());
    }
}
