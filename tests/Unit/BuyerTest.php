<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Shared\Models\Buyer;

class BuyerTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Buyer::class;
    }
}
