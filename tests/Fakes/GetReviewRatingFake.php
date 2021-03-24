<?php

namespace EolabsIo\AmazonMws\Tests\Fakes;

use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating;

class GetReviewRatingFake extends GetReviewRating
{
    public function get($url)
    {
        return Http::get($url);
    }
}
