<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceFeeEvent;

class PersistedServiceFeeEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\ServiceFeeEvent */
    public $serviceFeeEvent;

    public function __construct(ServiceFeeEvent $serviceFeeEvent)
    {
        $this->serviceFeeEvent = $serviceFeeEvent;
    }
}
