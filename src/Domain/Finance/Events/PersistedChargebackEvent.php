<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargebackEvent;

class PersistedChargebackEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\ChargebackEvent */
    public $chargebackEvent;

    public function __construct(ChargebackEvent $chargebackEvent)
    {
        $this->chargebackEvent = $chargebackEvent;
    }
}
