<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Support\Facades\GetReviewRating;
use EolabsIo\AmazonMws\Tests\Factories\GetReviewRatingFactory;

trait CreatesGetReviewRating
{
    public function createGetReviewRating($asin = "B00200000Q")
    {
        GetReviewRatingFactory::new()->fakeGetReviewRatingResponse();

        return GetReviewRating::withAsin($asin);
    }
}
