<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetReviewRating;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\PerformFetchGetReviewRating;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\ProcessGetReviewRatingResponse;

class PerformFetchGetReviewRatingTest extends TestCase
{
    use CreatesGetReviewRating;

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }


    /** @test */
    public function it_calls_the_correct_job()
    {
        $getReviewRating = $this->createGetReviewRating();

        PerformFetchGetReviewRating::dispatch($getReviewRating);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchGetReviewRating::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessGetReviewRatingResponse::class, function ($job) {
            return data_get($job->results, 'numberOfRatings') === 945
                && data_get($job->results, 'numberOfReviews') === 439
                && data_get($job->results, 'averageStarsRating') === 4.3
                && data_get($job->results, 'asin') === 'B00200000Q';
        });
    }
}
