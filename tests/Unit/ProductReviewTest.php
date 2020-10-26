<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;

class ProductReviewTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductReview::class;
    }
}
