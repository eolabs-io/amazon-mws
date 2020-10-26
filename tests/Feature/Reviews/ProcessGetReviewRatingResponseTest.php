<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetReviewRating;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ReviewRatingHistory;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\ProcessGetReviewRatingResponse;

class ProcessGetReviewRatingResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesGetReviewRating;

    protected function setUp(): void
    {
        parent::setUp();

        $getReviewRating = $this->createGetReviewRating();

        $results = $getReviewRating->fetch();
        $results['asin'] = $getReviewRating->getAsin();

        (new ProcessGetReviewRatingResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_review_rating_history_response()
    {
        $reviewRatingHistory = ReviewRatingHistory::first();

        $this->assertEquals('B00200000Q', $reviewRatingHistory->asin);
        $this->assertEquals(945, $reviewRatingHistory->number_of_ratings);
        $this->assertEquals(439, $reviewRatingHistory->number_of_reviews);
        $this->assertEquals(4.3, $reviewRatingHistory->average_stars_rating);
    }
}
