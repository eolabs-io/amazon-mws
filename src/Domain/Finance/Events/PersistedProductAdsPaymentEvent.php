<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\ProductAdsPaymentEvent;

class PersistedProductAdsPaymentEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\ProductAdsPaymentEvent */
    public $productAdsPaymentEvent;

    public function __construct(ProductAdsPaymentEvent $productAdsPaymentEvent)
    {
        $this->productAdsPaymentEvent = $productAdsPaymentEvent;
    }
}
