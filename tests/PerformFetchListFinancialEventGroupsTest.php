<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEventGroups;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\PerformFetchListFinancialEventGroups;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\ProcessListFinancialEventGroupsResponse;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListFinancialEventGroup;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;

class PerformFetchListFinancialEventGroupsTest extends TestCase
{
    use CreatesListFinancialEventGroup;

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
        $listFinancialEventGroup = $this->createListFinancialEventGroup();

        PerformFetchListFinancialEventGroups::dispatch($listFinancialEventGroup);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListFinancialEventGroups::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListFinancialEventGroupsResponse::class, function ($job) {
            return data_get($job->results, 'FinancialEventGroupList.0.FinancialEventGroupId') === '22YgYW55IGNhcm5hbCBwbGVhEXAMPLE';
        });

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchListFinancialEventGroups::class);
    }

    /** @test */
    public function it_calls_the_correct_job_with_token()
    {
        $listFinancialEventGroup = $this->createListFinancialEventGroupWithToken();

        PerformFetchListFinancialEventGroups::dispatch($listFinancialEventGroup);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListFinancialEventGroups::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListFinancialEventGroupsResponse::class, function ($job) {
            return data_get($job->results, 'FinancialEventGroupList.0.FinancialEventGroupId') === '22YgYW55IGNhcm5hbCBwbGVhEXAMPLE';
        });

        // Assert that was not called for NextToken
        Event::assertDispatched(FetchListFinancialEventGroups::class);
    }

}