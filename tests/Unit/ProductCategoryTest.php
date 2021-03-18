<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Products\Models\ProductCategory;

class ProductCategoryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductCategory::class;
    }
}
