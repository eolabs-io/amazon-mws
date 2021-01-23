<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;

class AmazonFulfilledShipmentWasUpdated
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment */
    public $shipment;

    public function __construct(AmazonFulfilledShipment $shipment)
    {
        $this->shipment = $shipment;
    }
}
