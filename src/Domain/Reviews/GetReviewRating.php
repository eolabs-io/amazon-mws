<?php

namespace EolabsIo\AmazonMws\Domain\Reviews;

use Illuminate\Support\Collection;
use EolabsIo\AmazonMws\Domain\Reviews\ReviewCore;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\ReviewRatingResponseParser;

class GetReviewRating extends ReviewCore
{
    // private $asin;

    // public function withAsin($asin): self
    // {
    //     $this->asin = $asin;

    //     return $this;
    // }

    // public function getAsin(): string
    // {
    //     return $this->asin;
    // }

    // public function parseResponse($response): Collection
    // {
    //     return ReviewRatingResponseParser::fromString($response);
    // }

    // public function getUrl(): string
    // {
    //     return "{$this->getBaseUrl()}/dp/{$this->asin}";
    // }
}
