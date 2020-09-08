<?php

namespace EolabsIo\AmazonMws\Domain\Reviews;

use Illuminate\Support\Facades\Http;
use DOMDocument;

class GetReview
{
    private $tagId = 'acrCustomerReviewText';
    private $asin;

    public function withAsin($asin): self
    {
        $this->asin = $asin;

        return $this;
    }

    public function withTagId($tagId): self
    {
        $this->$tagId = $tagId;

        return $this;
    }

    public function fetch(): array
    {
        $url = "{$this->getBaseUrl()}/dp/{$this->asin}";
        $response = Http::get($url);

        $dom = new DOMDocument();
        // @ symbol surpresses the page format error
        @$dom->loadHTML($response->body());
        $tagValue = $dom->getElementById($this->tagId)->nodeValue;
        $rating = explode(' ', $tagValue)[0];

        return ['rating' => $rating];
    }

    public function getBaseUrl(): string
    {
        return 'https://www.amazon.com';
    }
}
