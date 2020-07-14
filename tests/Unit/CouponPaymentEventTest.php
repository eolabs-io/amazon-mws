<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CouponPaymentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;

class CouponPaymentEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return CouponPaymentEvent::class;
    }

    /** @test */
    public function it_has_feeComponent_relationship()
    {
        $couponPaymentEvent = factory(CouponPaymentEvent::class)->create(['fee_component_id' => null]);
        $feeComponent = factory(FeeComponent::class)->create();

        $couponPaymentEvent->feeComponent()->associate($feeComponent);

        $this->assertArraysEqual($feeComponent->toArray(), $couponPaymentEvent->feeComponent->toArray());
    }

    /** @test */
    public function it_has_chargeComponent_relationship()
    {
        $couponPaymentEvent = factory(CouponPaymentEvent::class)->create(['charge_component_id' => null]);
        $chargeComponent = factory(ChargeComponent::class)->create();

        $couponPaymentEvent->chargeComponent()->associate($chargeComponent);

        $this->assertArraysEqual($chargeComponent->toArray(), $couponPaymentEvent->chargeComponent->toArray());
    }

    /** @test */
    public function it_has_totalAmount_relationship()
    {
        $couponPaymentEvent = factory(CouponPaymentEvent::class)->create(['total_amount_id' => null]);
        $totalAmount = factory(CurrencyAmount::class)->create();

        $couponPaymentEvent->totalAmount()->associate($totalAmount);

        $this->assertArraysEqual($totalAmount->toArray(), $couponPaymentEvent->totalAmount->toArray());
    }
}
