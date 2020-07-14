<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\SellerReviewEnrollmentPaymentEvent;


trait AssertsSellerReviewEnrollmentPaymentEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\SellerReviewEnrollmentPaymentEvent */
    public $sellerReviewEnrollmentPaymentEvent;

    public function assertSellerReviewEnrollmentPaymentEventResponse()
    {
        $sellerReviewEnrollmentPaymentEvent = SellerReviewEnrollmentPaymentEvent::where(["enrollment_id" => "MBJFKDSGJD"])
                                             ->first();

        $this->assertSeesSellerReviewEnrollmentPaymentEvent($sellerReviewEnrollmentPaymentEvent);
    }

    public function assertSeesSellerReviewEnrollmentPaymentEvent($event)
    {
        $this->sellerReviewEnrollmentPaymentEvent = $event;

        $this->assertEquals($this->sellerReviewEnrollmentPaymentEvent->enrollment_id, "MBJFKDSGJD");
        $this->assertEquals($this->sellerReviewEnrollmentPaymentEvent->parent_asin, "BYDFDFHDDFF");
        $this->assertEquals($this->sellerReviewEnrollmentPaymentEvent->feeComponent->feeAmount->currency_amount, 1.09);
        $this->assertEquals($this->sellerReviewEnrollmentPaymentEvent->chargeComponent->chargeAmount->currency_amount, 1.09);

        $this->sellerReviewEnrollmentPaymentEvent = null;
    }

}