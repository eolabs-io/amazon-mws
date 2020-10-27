<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewImage;

class ProductReviewTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ProductReview::class;
    }

    /** @test */
    public function it_has_ProductReviewImage_relationship()
    {
        $productReview = factory(ProductReview::class)->create();
        $image = factory(ProductReviewImage::class)->make();

        $productReview->images()->save($image);
        $productReviewImages = $productReview->images->pluck('url');

        $this->assertTrue($productReviewImages->contains($image->url));
    }
    /** @test */
    public function it_has_ProductReviewImages_relationship()
    {
        $productReview = factory(ProductReview::class)->create();
        $images = factory(ProductReviewImage::class, 3)->make();

        $productReview->images()->saveMany($images);
        $productReviewImages = $productReview->images->pluck('url');

        $this->assertEquals($productReviewImages->toArray(), $images->pluck('url')->toArray());
    }
}
