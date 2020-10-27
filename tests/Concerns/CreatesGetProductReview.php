<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Support\Facades\GetProductReview;
use EolabsIo\AmazonMws\Tests\Factories\GetProductReviewFactory;

trait CreatesGetProductReview
{
    public function createGetProductReview($asin = "B00200000Q")
    {
        GetProductReviewFactory::new()->fakeGetProductReviewResponse();

        return GetProductReview::withAsin($asin);
    }

    public function createGetProductReviewWithNoExtraPages($asin = "B00200000Q")
    {
        GetProductReviewFactory::new()->fakeGetProductReviewResponse();

        return GetProductReview::withAsin($asin)->withPageNumber(44);
    }

    public function createGetProductReviewWithImages($asin = "B00200000Q")
    {
        GetProductReviewFactory::new()->fakeGetProductReviewWithImagesResponse();

        return GetProductReview::withAsin($asin);
    }
}
