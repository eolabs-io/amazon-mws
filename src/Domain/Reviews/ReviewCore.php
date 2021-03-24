<?php

namespace EolabsIo\AmazonMws\Domain\Reviews;

use Illuminate\Support\Collection;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\BrowserKit\HttpBrowser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\ReviewResponseParser;

abstract class ReviewCore
{
    public $parsedResponse;
    private $asin;

    public function withAsin($asin): self
    {
        $this->asin = $asin;

        return $this;
    }

    public function getAsin(): string
    {
        return $this->asin;
    }

    // public function fetch(): Collection
    // {
    //     $response = Http::get($this->getUrl());
    //     $this->parsedResponse = $this->parseResponse($response);

    //     return $this->getParsedResponse();
    // }

    public function fetch(): Collection
    {
        $response = $this->get($this->getUrl());

        $this->parsedResponse = $this->parseResponse($response);

        return $this->getParsedResponse();
    }

    public function get($url)
    {
        $browser = new HttpBrowser(HttpClient::create());
        $browser->request('GET', $url);

        return $browser->getResponse();
    }

    public function getQueryParameters(): array
    {
        return [];
    }

    public function parseResponse($response): Collection
    {
        return ReviewResponseParser::fromString($response);
    }

    public function getUrl(): string
    {
        $url = "{$this->getBaseUrl()}/product-reviews/{$this->getAsin()}";

        return $this->applyQuery($url);
    }

    public function applyQuery($url): string
    {
        $query = $this->getQueryParameters();
        if (! empty($query)) {
            $url .= '?' . http_build_query($query);
        }
        return $url;
    }

    public function getBaseUrl(): string
    {
        return 'https://www.amazon.com';
    }

    public function getParsedResponse(): Collection
    {
        return $this->parsedResponse ?? collect();
    }
}
