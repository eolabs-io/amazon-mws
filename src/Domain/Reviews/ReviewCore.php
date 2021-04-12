<?php

namespace EolabsIo\AmazonMws\Domain\Reviews;

use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use EolabsIo\AmazonMws\Domain\Reviews\Concerns\SolvesCaptcha;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\ReviewResponseParser;

abstract class ReviewCore
{
    use SolvesCaptcha;

    public $parsedResponse;
    private $asin;
    private HttpBrowser $browser;
    private HttpClientInterface $client;
    protected Crawler $crawler;


    public function __construct(?HttpClientInterface $client = null, ?HttpBrowser $browser = null, ?string $baseUrl = null)
    {
        $baseUrl = $baseUrl ?? $this->getBaseUrl();
        $this->client = $client ?? HttpClient::createForBaseUri($baseUrl);
        $this->browser = $browser ?? new HttpBrowser($this->client);
    }

    public function withAsin($asin): self
    {
        $this->asin = $asin;

        return $this;
    }

    public function getAsin(): string
    {
        return $this->asin;
    }

    public function fetch(): Collection
    {
        $response = $this->get($this->getUrl());

        $parsedResponse = $this->parseResponse($response);

        // Check for Captcha
        if ($this->hasCaptcha($parsedResponse)) {
            $response = $this->solveCaptcha();
            $parsedResponse = $this->parseResponse($response);
        }

        $this->parsedResponse = $parsedResponse;

        return $this->getParsedResponse();
    }

    public function get($url)
    {
        $browser = $this->getBrowser();

        $this->crawler = $browser->request('GET', $url);

        return $browser->getResponse();
    }

    public function getBrowser(): HttpBrowser
    {
        return $this->browser;
    }

    public function getClient(): HttpClientInterface
    {
        return $this->client;
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

    public function hasCaptcha($parsedResponse): bool
    {
        return data_get($parsedResponse, 'hasCaptcha', false);
    }
}
