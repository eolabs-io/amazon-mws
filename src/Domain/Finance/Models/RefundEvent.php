<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Concerns\HasNumberOfRefundEvents;

class RefundEvent extends ShipmentEvent
{
    use HasNumberOfRefundEvents;
}
