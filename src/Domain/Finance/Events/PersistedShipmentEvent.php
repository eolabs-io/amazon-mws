<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentEvent;

class PersistedShipmentEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentEvent */
    public $shipmentEvent;

    public function __construct(ShipmentEvent $shipmentEvent)
    {
        $this->shipmentEvent = $shipmentEvent;
    }
}
