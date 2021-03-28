<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\DirectPayment;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class DirectPaymentTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return DirectPayment::class;
    }

    /** @test */
    public function it_has_directPayment_relationship()
    {
        $directPayment = DirectPayment::factory()->create(['direct_payment_amount_id' => null]);
        $directPaymentAmount = CurrencyAmount::factory()->create();

        $directPayment->directPaymentAmount()->associate($directPaymentAmount);

        $this->assertArraysEqual($directPaymentAmount->toArray(), $directPayment->directPaymentAmount->toArray());
    }
}
