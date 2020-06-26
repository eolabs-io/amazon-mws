<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrders;
use EolabsIo\AmazonMws\Domain\Orders\Jobs\PerformFetchListOrders;
use EolabsIo\AmazonMws\Domain\Orders\Jobs\ProcessListOrdersResponse;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListOrders;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;

class PerformFetchListOrdersTest extends TestCase
{
    use CreatesListOrders;

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
    public function it_calls_the_correct_job_without_token()
    {
        $listOrders = $this->createListOrders();

        PerformFetchListOrders::dispatch($listOrders);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListOrders::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListOrdersResponse::class, function ($job) {
            return data_get($job->results, 'Orders.0.AmazonOrderId') === '902-3159896-1390916';
        });

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchListOrders::class);
    }

    /** @test */
    public function it_calls_the_correct_job_with_token()
    {
        $listOrders = $this->createListOrdersWithToken();

        PerformFetchListOrders::dispatch($listOrders);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListOrders::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListOrdersResponse::class, function ($job) {
            return data_get($job->results, 'Orders.0.AmazonOrderId') === '902-3159896-1390916';
        });

        // Assert that was not called for NextToken
        Event::assertDispatched(FetchListOrders::class);
    }

}