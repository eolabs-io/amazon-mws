<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Support\Facades\GetReview;
use EolabsIo\AmazonMws\Tests\Factories\GetReviewFactory;

class GetReviewTest extends TestCase
{
    /** @test */
    public function it_gets_the_correct_rating()
    {
        // GetReviewFactory::new()->fakeGetReviewResponse();

        $asin = 'B079C9HTFJ'; //"B002KT3XRQ";

        $response = GetReview::withAsin($asin)
                        ->fetch();

        $expected = 47;

        $this->assertEquals($expected, $response['rating']);
    }
}
