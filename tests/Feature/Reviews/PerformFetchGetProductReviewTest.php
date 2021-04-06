<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Support\Facades\GetProductReview;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetProductReview;
use EolabsIo\AmazonMws\Tests\Factories\Concerns\CreatesSolverMock;
use EolabsIo\AmazonMws\Domain\Reviews\Events\FetchGetProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\PerformFetchGetProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\ProcessGetProductReviewResponse;

class PerformFetchGetProductReviewTest extends TestCase
{
    use CreatesGetProductReview,
        CreatesSolverMock;

    public $asin;

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();

        $this->asin = "B00200000Q";
    }

    /** @test */
    public function it_calls_the_correct_job()
    {
        GetProductReview::fake();

        $getReviewRating = GetProductReview::withAsin($this->asin);

        PerformFetchGetProductReview::dispatch($getReviewRating);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchGetProductReview::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessGetProductReviewResponse::class, function ($job) {
            return data_get($job->results, 'numberOfReviews') === 439
                && data_get($job->results, 'averageStarsRating') === 4.3
                && data_get($job->results, 'asin') === 'B00200000Q'
                && count(data_get($job->results, 'reviews')) == 10;
        });

        // Assert that was called for NextPage
        Event::assertDispatched(FetchGetProductReview::class);
    }

    /** @test */
    public function it_calls_the_correct_job_with_no_extra_pages()
    {
        GetProductReview::fake();

        $getReviewRating = GetProductReview::withAsin($this->asin)->withPageNumber(44);

        PerformFetchGetProductReview::dispatch($getReviewRating);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchGetProductReview::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessGetProductReviewResponse::class, function ($job) {
            return data_get($job->results, 'numberOfReviews') === 439
                    && data_get($job->results, 'averageStarsRating') === 4.3
                    && data_get($job->results, 'asin') === 'B00200000Q'
                    && count(data_get($job->results, 'reviews')) == 10;
        });

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchGetProductReview::class);
    }
}
