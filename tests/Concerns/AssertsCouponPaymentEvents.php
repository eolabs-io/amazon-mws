<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\CouponPaymentEvent;


trait AssertsCouponPaymentEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\CouponPaymentEvent */
    public $couponPaymentEvent;

    public function assertCouponPaymentEventResponse()
    {
        $couponPaymentEvent = CouponPaymentEvent::first();

        $this->assertSeesCouponPaymentEvent($couponPaymentEvent);
    }

    public function assertSeesCouponPaymentEvent($event)
    {
        $this->couponPaymentEvent = $event;
        
        $this->assertEquals($this->couponPaymentEvent->coupon_id, "AWURESTX");

        $this->assertEquals($this->couponPaymentEvent->feeComponent->feeAmount->currency_amount, 1.09);
		$this->assertEquals($this->couponPaymentEvent->chargeComponent->chargeAmount->currency_amount, 1.09);

        $this->couponPaymentEvent = null;
    }

}