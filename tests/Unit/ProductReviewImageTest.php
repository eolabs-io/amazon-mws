<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewImage;

class ProductReviewImageTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductReviewImage::class;
    }

    /** @test */
    public function it_has_ProductReview_relationship()
    {
        $productReview = factory(ProductReview::class)->create();
        $productReviewImage = factory(ProductReviewImage::class)->create(['product_review_id' => $productReview->id]);

        $this->assertEquals($productReview->toArray(), $productReviewImage->productReview->toArray());
    }
}
