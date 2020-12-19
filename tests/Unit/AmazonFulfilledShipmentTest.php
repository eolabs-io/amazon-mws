<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;

class AmazonFulfilledShipmentTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return AmazonFulfilledShipment::class;
    }
}
