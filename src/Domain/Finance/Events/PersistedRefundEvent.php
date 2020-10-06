<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\RefundEvent;

class PersistedRefundEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\RefundEvent */
    public $refundEvent;

    public function __construct(RefundEvent $refundEvent)
    {
        $this->refundEvent = $refundEvent;
    }
}
