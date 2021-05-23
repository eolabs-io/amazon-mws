<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewStatus;

class ProductReviewStatuswTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductReviewStatus::class;
    }
}
