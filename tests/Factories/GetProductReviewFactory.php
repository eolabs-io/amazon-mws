<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use Illuminate\Support\Facades\Http;

class GetProductReviewFactory
{
    private $endpoint = 'https://www.amazon.com/*';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakeGetProductReviewResponse(): self
    {
        $file = __DIR__ . '/../Stubs/Responses/Html/AmazonProductReviewPage.html';
        $getReviewResponse = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($getReviewResponse, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakeGetProductReviewWithImagesResponse(): self
    {
        $file = __DIR__ . '/../Stubs/Responses/Html/AmazonProductReviewWithImagesPage.html';
        $getReviewResponse = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($getReviewResponse, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakeGetProductReviewWithCaptchaResponse(): self
    {
        $file = __DIR__ . '/../Stubs/Responses/Html/AmazonProductReviewWithCaptcha.html';
        $getCaptchaReviewResponse = file_get_contents($file);

        $file = __DIR__ . '/../Stubs/Responses/Html/AmazonProductReviewPage.html';
        $getReviewResponse = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($getCaptchaReviewResponse, 200)
                                    ->push($getReviewResponse, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }
}
