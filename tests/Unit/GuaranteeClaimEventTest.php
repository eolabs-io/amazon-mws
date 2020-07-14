<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\GuaranteeClaimEvent;
use EolabsIo\AmazonMws\Tests\Unit\ShipmentEventTest;


class GuaranteeClaimEventTest extends ShipmentEventTest
{

    protected function getModelClass()
    {
        return GuaranteeClaimEvent::class;
    }

}