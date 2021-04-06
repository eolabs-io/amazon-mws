<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Support\Facades\GetProductReview;
use EolabsIo\AmazonMws\Tests\Factories\Concerns\CreatesSolverMock;

class GetProductReviewTest extends TestCase
{
    use CreatesSolverMock;

    public $asin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->asin = "B00200000Q";
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        GetProductReview::fake();

        $response = GetProductReview::withAsin($this->asin)->fetch();

        $this->assertEquals(1, $response['pageNumber']);
        $this->assertEquals(2, $response['nextPage']);
        $this->assertEquals(44, $response['totalNumberOfPages']);
        $this->assertEquals(4.3, $response['averageStarsRating']);
        $this->assertEquals(439, $response['numberOfReviews']);
        $this->assertEquals(945, $response['numberOfRatings']);
        $this->assertCount(10, $response['reviews']);

        $this->assertFalse($response['hasCaptcha']);
    }

    /** @test */
    public function it_can_change_the_page_response()
    {
        GetProductReview::fake();

        $response = GetProductReview::withAsin($this->asin)
                            ->withPageNumber(2)
                            ->fetch();

        $this->assertEquals(2, $response['pageNumber']);
        $this->assertEquals(3, $response['nextPage']);
        $this->assertEquals(44, $response['totalNumberOfPages']);
        $this->assertEquals(4.3, $response['averageStarsRating']);
        $this->assertEquals(439, $response['numberOfReviews']);
        $this->assertEquals(945, $response['numberOfRatings']);
        $this->assertCount(10, $response['reviews']);

        $this->assertFalse($response['hasCaptcha']);
    }

    /** @test */
    public function it_gets_the_correct_with_captcha_response()
    {
        GetProductReview::fake([
            'type' => '__WithCaptcha__',
            'solverCallback' => function () {
                return $this->createSolverMock();
            },
        ]);

        $response = GetProductReview::withAsin($this->asin)->fetch();

        $this->assertEquals(1, $response['pageNumber']);
        $this->assertEquals(2, $response['nextPage']);
        $this->assertEquals(44, $response['totalNumberOfPages']);
        $this->assertEquals(4.3, $response['averageStarsRating']);
        $this->assertEquals(439, $response['numberOfReviews']);
        $this->assertEquals(945, $response['numberOfRatings']);
        $this->assertCount(10, $response['reviews']);

        $this->assertFalse($response['hasCaptcha']);
    }
}
