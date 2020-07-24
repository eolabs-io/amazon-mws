<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Products\Jobs\PerformFetchGetMatchingProduct;
use EolabsIo\AmazonMws\Domain\Products\Jobs\ProcessGetMatchingProductsResponse;
use EolabsIo\AmazonMws\Support\Facades\GetMatchingProduct;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetMatchingProduct;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;

class PerformFetchGetMatchingProductTest extends TestCase
{
    use CreatesGetMatchingProduct;

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
        $getMatchingProduct = $this->createGetMatchingProduct();

        PerformFetchGetMatchingProduct::dispatch($getMatchingProduct);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchGetMatchingProduct::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessGetMatchingProductsResponse::class, function ($job) {
            return data_get($job->results, 'Products.0.Product.Identifiers.MarketplaceASIN.ASIN') === 'B002KT3XRQ';
        });

    }

}