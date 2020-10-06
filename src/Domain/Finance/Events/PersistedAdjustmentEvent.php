<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;

class PersistedAdjustmentEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent */
    public $adjustmentEvent;

    public function __construct(AdjustmentEvent $adjustmentEvent)
    {
        $this->adjustmentEvent = $adjustmentEvent;
    }
}
