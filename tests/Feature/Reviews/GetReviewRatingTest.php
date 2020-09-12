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
        GetReviewRatingFactory::new()->fakeGetReviewRatingResponse();

        $asin = "B00200000Q";
        $response = GetReviewRating::withAsin($asin)
                        ->fetch();

        $this->assertEquals(11976, $response['ratings']);
        $this->assertEquals(4.7, $response['averageStarsRating']);
    }
}
