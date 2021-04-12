<?php

namespace EolabsIo\AmazonMws\Tests\Fakes;

use Symfony\Component\HttpClient\Response\MockResponse;
use EolabsIo\AmazonMws\Tests\Fakes\GetProductReviewFake;

class GetProductReviewWithCaptchaFake extends GetProductReviewFake
{
    public function getResponses(): array
    {
        $captchResponse = $this->getCaptchResponse();
        $reviewResponse = $this->getReviewResponse();

        return [
            new MockResponse($captchResponse),
            new MockResponse($reviewResponse),
        ];
    }
}
