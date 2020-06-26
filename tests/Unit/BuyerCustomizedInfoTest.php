<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerCustomizedInfo;

class BuyerCustomizedInfoTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return BuyerCustomizedInfo::class;
    }
}
