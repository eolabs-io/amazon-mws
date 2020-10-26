<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Support\Facades\GetProductReview;
use EolabsIo\AmazonMws\Tests\Factories\GetProductReviewFactory;

class GetProductReviewTest extends TestCase
{

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        GetProductReviewFactory::new()->fakeGetProductReviewResponse();

        $asin = "B00200000Q";
        $pageNumber = 2;
        GetProductReview::withAsin($asin)
            ->withPageNumber($pageNumber)
            ->fetch();

        Http::assertSent(function ($request) use ($asin, $pageNumber) {
            return $request->url() == "https://www.amazon.com/product-reviews/{$asin}?pageNumber={$pageNumber}";
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        GetProductReviewFactory::new()->fakeGetProductReviewResponse();

        $asin = "B00200000Q";
        $response = GetProductReview::withAsin($asin)
                        ->fetch();

        $this->assertEquals(1, $response['pageNumber']);
        $this->assertEquals(2, $response['nextPage']);
        $this->assertEquals(44, $response['totalNumberOfPages']);
        $this->assertEquals(4.3, $response['averageStarsRating']);
        $this->assertEquals(439, $response['numberOfReviews']);
        $this->assertEquals(945, $response['numberOfRatings']);
        $this->assertCount(10, $response['reviews']);
    }

    /** @test */
    public function it_can_change_the_page_response()
    {
        GetProductReviewFactory::new()->fakeGetProductReviewResponse();
        $pageNumber = 2;
        $asin = "B00200000Q";
        $response = GetProductReview::withAsin($asin)
                            ->withPageNumber($pageNumber)
                            ->fetch();

        $this->assertEquals(2, $response['pageNumber']);
        $this->assertEquals(3, $response['nextPage']);
        $this->assertEquals(44, $response['totalNumberOfPages']);
        $this->assertEquals(4.3, $response['averageStarsRating']);
        $this->assertEquals(439, $response['numberOfReviews']);
        $this->assertEquals(945, $response['numberOfRatings']);
        $this->assertCount(10, $response['reviews']);
    }
}
