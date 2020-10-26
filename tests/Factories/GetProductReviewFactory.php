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

    // public function fakeGetMatchingProductWithErrorResponse(): self
    // {

    //     $file = __DIR__ . '/../Stubs/Responses/fetchGetMatchingProductWithError.xml';
    //     $getMatchingProductResponse = file_get_contents($file);

    //     Http::fake([
    //          $this->endpoint => Http::sequence()
    //                                 ->push($getMatchingProductResponse, 200)
    //                                 ->whenEmpty(Http::response('', 404)),
    //     ]);

    //     return $this;
    // }
}
