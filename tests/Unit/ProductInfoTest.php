<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\ProductInfo;

class ProductInfoTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return ProductInfo::class;
    }
}
