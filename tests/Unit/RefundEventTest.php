<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\RefundEvent;
use EolabsIo\AmazonMws\Tests\Unit\ShipmentEventTest;


class RefundEventTest extends ShipmentEventTest
{

    protected function getModelClass()
    {
        return RefundEvent::class;
    }

}