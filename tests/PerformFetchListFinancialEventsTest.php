<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\PerformFetchListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\ProcessListFinancialEventsResponse;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListFinancialEvent;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;

class PerformFetchListFinancialEventsTest extends TestCase
{
    use CreatesListFinancialEvent;

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
    public function it_calls_the_correct_job_with_no_token()
    {
        $listFinancialEvent = $this->createListFinancialEvent();

        PerformFetchListFinancialEvents::dispatch($listFinancialEvent);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListFinancialEvents::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListFinancialEventsResponse::class, function ($job) {
            return data_get($job->results, 'FinancialEvents.SellerDealPaymentEventList.0.DealDescription') === 'test fees';
        });

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchListFinancialEvents::class);
    }

    /** @test */
    public function it_calls_the_correct_job_with_token()
    {
        $listFinancialEvent = $this->createListFinancialEventWithToken();

        PerformFetchListFinancialEvents::dispatch($listFinancialEvent);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListFinancialEvents::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListFinancialEventsResponse::class, function ($job) {
            return data_get($job->results, 'FinancialEvents.SellerDealPaymentEventList.0.DealDescription') === 'test fees';
        });

        // Assert that was not called for NextToken
        Event::assertDispatched(FetchListFinancialEvents::class);
    }

}