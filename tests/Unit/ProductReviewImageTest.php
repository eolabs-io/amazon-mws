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
        $productReview = ProductReview::factory()->create();
        $productReviewImage = ProductReviewImage::factory()->create(['product_review_id' => $productReview->id]);

        $this->assertEquals($productReview->toArray(), $productReviewImage->productReview->toArray());
    }
}
