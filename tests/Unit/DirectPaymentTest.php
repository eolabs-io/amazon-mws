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
        $directPayment = factory(DirectPayment::class)->create(['direct_payment_amount_id' => null]);
        $directPaymentAmount = factory(CurrencyAmount::class)->create();

        $directPayment->directPaymentAmount()->associate($directPaymentAmount);

        $this->assertArraysEqual($directPaymentAmount->toArray(), $directPayment->directPaymentAmount->toArray());
    }
}
