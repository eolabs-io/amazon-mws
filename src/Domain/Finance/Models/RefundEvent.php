<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentEvent;
use EolabsIo\AmazonMws\Database\Factories\RefundEventFactory;
use EolabsIo\AmazonMws\Domain\Finance\Concerns\HasNumberOfRefundEvents;

class RefundEvent extends ShipmentEvent
{
    use HasNumberOfRefundEvents;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return RefundEventFactory::new();
    }
}
