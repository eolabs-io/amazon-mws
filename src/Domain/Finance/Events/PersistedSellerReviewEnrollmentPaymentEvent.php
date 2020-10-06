<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\SellerReviewEnrollmentPaymentEvent;

class PersistedSellerReviewEnrollmentPaymentEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\SellerReviewEnrollmentPaymentEvent */
    public $sellerReviewEnrollmentPaymentEvent;

    public function __construct(SellerReviewEnrollmentPaymentEvent $sellerReviewEnrollmentPaymentEvent)
    {
        $this->sellerReviewEnrollmentPaymentEvent = $sellerReviewEnrollmentPaymentEvent;
    }
}
