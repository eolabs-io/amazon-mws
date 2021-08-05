<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Support\Facades\GetReviewRating;
use EolabsIo\AmazonMws\Tests\Factories\GetReviewRatingFactory;

class GetReviewRatingTest extends TestCase
{
    /** @test */
    public function it_gets_the_correct_rating()
    {
        GetReviewRating::fake();
        GetReviewRatingFactory::new()->fakeGetReviewRatingResponse();

        $asin = "B00200000Q";
        $response = GetReviewRating::withAsin($asin)
                        ->fetch();

        $this->assertEquals(1681, $response['numberOfRatings']);
        $this->assertEquals(479, $response['numberOfReviews']);
        $this->assertEquals(4.3, $response['averageStarsRating']);
    }
}
