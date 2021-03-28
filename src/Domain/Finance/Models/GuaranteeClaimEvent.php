<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentEvent;
use EolabsIo\AmazonMws\Database\Factories\GuaranteeClaimEventFactory;

class GuaranteeClaimEvent extends ShipmentEvent
{
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return GuaranteeClaimEventFactory::new();
    }
}
