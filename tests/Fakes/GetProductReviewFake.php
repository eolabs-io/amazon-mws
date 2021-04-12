<?php

namespace EolabsIo\AmazonMws\Tests\Fakes;

use TwoCaptcha\TwoCaptcha;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use EolabsIo\AmazonMws\Domain\Reviews\GetProductReview;
use Symfony\Component\HttpClient\Response\MockResponse;

class GetProductReviewFake extends GetProductReview
{
    public $mockedSolver;


    public function __construct(?HttpClientInterface $client = null, ?HttpBrowser $browser = null, ?string $baseUrl = null)
    {
        $client = $client ?? $this->mockHttpClient();

        parent::__construct($client, $browser, $baseUrl);
    }

    public function mockHttpClient(): HttpClientInterface
    {
        $responses = $this->getResponses();

        return new MockHttpClient($responses);
    }

    public function getResponses(): array
    {
        $reviewResponse = $this->getReviewResponse();

        return [
            new MockResponse($reviewResponse),
        ];
    }

    public function getCaptchResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Html/AmazonProductReviewWithCaptcha.html';
        return file_get_contents($file);
    }

    public function getReviewResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Html/AmazonProductReviewPage.html';
        return file_get_contents($file);
    }

    public function getReviewWithImagesResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Html/AmazonProductReviewWithImagesPage.html';
        return file_get_contents($file);
    }

    public function getSolver(): TwoCaptcha
    {
        return $this->mockedSolver;
    }

    public function setMockedSolver($mockedSolver)
    {
        $this->mockedSolver = $mockedSolver;
    }
}
