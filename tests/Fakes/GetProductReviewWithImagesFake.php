<?php

namespace EolabsIo\AmazonMws\Tests\Fakes;

use Symfony\Component\HttpClient\Response\MockResponse;

class GetProductReviewWithImagesFake extends GetProductReviewFake
{
    public function getResponses(): array
    {
        $reviewResponse = $this->getReviewWithImagesResponse();

        return [
            new MockResponse($reviewResponse),
        ];
    }
}
