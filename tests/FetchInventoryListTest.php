<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Inventory\Jobs\FetchInventoryList;
use EolabsIo\AmazonMws\Domain\Inventory\Jobs\ProcessInventoryListResponse;
use EolabsIo\AmazonMws\Support\Facades\InventoryList;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesInventoryList;
use EolabsIo\AmazonMws\Tests\Factories\InventoryFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;

class FetchInventoryListTest extends TestCase
{
    use CreatesInventoryList;

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
        $inventoryList = $this->createInventoryList();

        FetchInventoryList::dispatch($inventoryList);

        // Assert a job was pushed...
        Queue::assertPushed(FetchInventoryList::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessInventoryListResponse::class, function ($job) {
            return data_get($job->results, 'InventorySupplyList.0.SellerSKU') === 'SampleSKU1';
        });

        // Assert that was not called for NextToken
        Queue::assertPushed(FetchInventoryList::class, 1);
    }

    /** @test */
    public function it_calls_the_correct_job_with_token()
    {
        $inventoryList = $this->createInventoryListWithToken();

        FetchInventoryList::dispatch($inventoryList);

        // Assert a job was pushed...
        Queue::assertPushed(FetchInventoryList::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessInventoryListResponse::class, function ($job) {
            return data_get($job->results, 'InventorySupplyList.0.SellerSKU') === 'SampleSKU1';
        });

        // Assert that was not called for NextToken
        Queue::assertPushed(FetchInventoryList::class, 2);
    }

}