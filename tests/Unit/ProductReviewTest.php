<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewImage;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewStatus;

class ProductReviewTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductReview::class;
    }

    /** @test */
    public function it_has_ProductReviewImage_relationship()
    {
        $productReview = ProductReview::factory()->create();
        $image = ProductReviewImage::factory()->make();

        $productReview->images()->save($image);
        $productReviewImages = $productReview->images->pluck('url');

        $this->assertTrue($productReviewImages->contains($image->url));
    }

    /** @test */
    public function it_has_ProductReviewImages_relationship()
    {
        $productReview = ProductReview::factory()->create();
        $images = ProductReviewImage::factory()->times(3)->make();

        $productReview->images()->saveMany($images);
        $productReviewImages = $productReview->images->pluck('url');

        $this->assertEquals($productReviewImages->toArray(), $images->pluck('url')->toArray());
    }

    /** @test */
    public function it_has_ProductReviewStatus_relationship()
    {
        $expectedStatus = ProductReviewStatus::factory()->create();
        ProductReview::factory()->create(['product_review_status_id' => $expectedStatus->id]);

        $productReview = ProductReview::first();
        $actualStatus = $productReview->status;

        $this->assertEquals($expectedStatus->toArray(), $actualStatus->toArray());
    }
}
