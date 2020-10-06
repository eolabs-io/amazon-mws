<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\CouponPaymentEvent;

class PersistedCouponPaymentEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\CouponPaymentEvent */
    public $couponPaymentEvent;

    public function __construct(CouponPaymentEvent $couponPaymentEvent)
    {
        $this->couponPaymentEvent = $couponPaymentEvent;
    }
}
