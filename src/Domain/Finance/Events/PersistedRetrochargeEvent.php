<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\RetrochargeEvent;

class PersistedRetrochargeEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\RetrochargeEvent */
    public $retrochargeEvent;

    public function __construct(RetrochargeEvent $retrochargeEvent)
    {
        $this->retrochargeEvent = $retrochargeEvent;
    }
}
