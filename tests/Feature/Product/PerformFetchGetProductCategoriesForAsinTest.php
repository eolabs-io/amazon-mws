<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Product;

use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetProductCategoriesForAsin;
use EolabsIo\AmazonMws\Domain\Products\Jobs\PerformFetchGetProductCategoriesForAsin;
use EolabsIo\AmazonMws\Domain\Products\Jobs\ProcessGetProductCategoriesForAsinResponse;

class PerformFetchGetProductCategoriesForAsinTest extends TestCase
{
    use CreatesGetProductCategoriesForAsin;

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_calls_the_correct_job()
    {
        $getProductCategoriesForAsin = $this->createGetProductCategoriesForAsin();

        PerformFetchGetProductCategoriesForAsin::dispatch($getProductCategoriesForAsin);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchGetProductCategoriesForAsin::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessGetProductCategoriesForAsinResponse::class, function ($job) {
            return data_get($job->results, 'Self.0.ProductCategoryId') === '2420095011';
        });
    }
}
