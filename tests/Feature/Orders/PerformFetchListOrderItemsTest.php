<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Orders;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrderItems;
use EolabsIo\AmazonMws\Domain\Orders\Jobs\PerformFetchListOrderItems;
use EolabsIo\AmazonMws\Domain\Orders\Jobs\ProcessListOrderItemsResponse;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListOrderItems;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;

class PerformFetchListOrderItemsTest extends TestCase
{
    use CreatesListOrderItems;

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
    public function it_calls_the_correct_job_with_with_token()
    {
        $listOrderItems = $this->createListOrderItems();

        PerformFetchListOrderItems::dispatch($listOrderItems);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListOrderItems::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListOrderItemsResponse::class, function ($job) {
            return data_get($job->results, 'OrderItems.0.ASIN') === 'BT0093TELA';
        });

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchListOrderItems::class);
    }

    /** @test */
    public function it_calls_the_correct_job_with_token()
    {
        $listOrderItems = $this->createListOrderItemsWithToken();

        PerformFetchListOrderItems::dispatch($listOrderItems);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListOrderItems::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListOrderItemsResponse::class, function ($job) {
            return data_get($job->results, 'OrderItems.0.ASIN') === 'BT0093TELA';
        });

        // Assert that was not called for NextToken
        Event::assertDispatched(FetchListOrderItems::class);
    }

}