<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargebackEvent;
use EolabsIo\AmazonMws\Tests\Unit\ShipmentEventTest;


class ChargebackEventTest extends ShipmentEventTest
{

    protected function getModelClass()
    {
        return ChargebackEvent::class;
    }

}