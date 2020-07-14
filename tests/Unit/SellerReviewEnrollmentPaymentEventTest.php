<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\SellerReviewEnrollmentPaymentEvent;

class SellerReviewEnrollmentPaymentEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return SellerReviewEnrollmentPaymentEvent::class;
    }

    /** @test */
    public function it_has_feeComponent_relationship()
    {
        $sellerReviewEnrollmentPaymentEvent = factory(SellerReviewEnrollmentPaymentEvent::class)->create();
        $feeComponent = factory(FeeComponent::class)->create();

        $sellerReviewEnrollmentPaymentEvent->feeComponent()->associate($feeComponent);

        $this->assertArraysEqual($feeComponent->toArray(), $sellerReviewEnrollmentPaymentEvent->feeComponent->toArray(['fee_component_id' => null]));
    }

    /** @test */
    public function it_has_chargeComponent_relationship()
    {
        $sellerReviewEnrollmentPaymentEvent = factory(SellerReviewEnrollmentPaymentEvent::class)->create(['charge_component_id' => null]);
        $chargeComponent = factory(ChargeComponent::class)->create();

        $sellerReviewEnrollmentPaymentEvent->chargeComponent()->associate($chargeComponent);

        $this->assertArraysEqual($chargeComponent->toArray(), $sellerReviewEnrollmentPaymentEvent->chargeComponent->toArray());
    }

    /** @test */
    public function it_has_totalAmount_relationship()
    {
        $sellerReviewEnrollmentPaymentEvent = factory(SellerReviewEnrollmentPaymentEvent::class)->create(['total_amount_id' => null]);
        $totalAmount = factory(CurrencyAmount::class)->create();

        $sellerReviewEnrollmentPaymentEvent->totalAmount()->associate($totalAmount);

        $this->assertArraysEqual($totalAmount->toArray(), $sellerReviewEnrollmentPaymentEvent->totalAmount->toArray());
    }
}
