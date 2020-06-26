<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerTaxInfo;

class BuyerTaxInfoTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return BuyerTaxInfo::class;
    }
}
