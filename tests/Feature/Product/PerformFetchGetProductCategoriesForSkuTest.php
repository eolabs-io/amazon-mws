<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Product;

use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetProductCategoriesForSku;
use EolabsIo\AmazonMws\Domain\Products\Jobs\PerformFetchGetProductCategoriesForSku;
use EolabsIo\AmazonMws\Domain\Products\Jobs\ProcessGetProductCategoriesForSkuResponse;

class PerformFetchGetProductCategoriesForSkuTest extends TestCase
{
    use CreatesGetProductCategoriesForSku;

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
        $getProductCategoriesForSku = $this->createGetProductCategoriesForSku();

        PerformFetchGetProductCategoriesForSku::dispatch($getProductCategoriesForSku);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchGetProductCategoriesForSku::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessGetProductCategoriesForSkuResponse::class, function ($job) {
            return data_get($job->results, 'Self.0.ProductCategoryId') === '271578011';
        });
    }
}
