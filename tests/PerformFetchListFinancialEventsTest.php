<?php

namespace EolabsIo\AmazonMws\Tests;

use Mockery;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\PerformFetchListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\ProcessListFinancialEventsResponse;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListFinancialEvent;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Queue\Events\JobProcessed;
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
        $knownDate = Carbon::create("Wed, 06 Mar 2013 19:07:58 GMT")->subHour();
        Carbon::setTestNow($knownDate);  
        Queue::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Carbon::setTestNow(); 
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

    /** @test */
    public function it_handles_quota_exceeded_exception()
    {
        $listFinancialEvent = $this->createListFinancialEventQuotaExceededError();

        $job = Mockery::mock(PerformFetchListFinancialEvents::class.'[release,fail]', [$listFinancialEvent]);
        $job->shouldReceive('release')->once()->with(3600);
        $job->shouldNotReceive('fail');

        $job->handle();

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchListFinancialEvents::class);
    }

    /** @test */
    public function it_handles_throttling_exception()
    {
        $listFinancialEvent = $this->createListFinancialEventThrottledError();

        $job = Mockery::mock(PerformFetchListFinancialEvents::class.'[release,fail]', [$listFinancialEvent]);
        $job->shouldReceive('release')->once()->with(30);
        $job->shouldNotReceive('fail');

        $job->handle();

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchListFinancialEvents::class);
    }

    /** @test */
    public function it_handles_request_exception()
    {
        $listFinancialEvent = $this->createListFinancialEventInputStreamDisconnectedError();

        $job = Mockery::mock(PerformFetchListFinancialEvents::class.'[release,fail]', [$listFinancialEvent]);
        $job->shouldNotReceive('release');
        $job->shouldReceive('fail');

        $job->handle();

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchListFinancialEvents::class);
    }
}