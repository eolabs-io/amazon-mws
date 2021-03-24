<?php

namespace EolabsIo\AmazonMws\Tests\Fakes;

use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Domain\Reviews\GetProductReview;

class GetProductReviewFake extends GetProductReview
{
    public function get($url)
    {
        return Http::get($url);
    }
}
