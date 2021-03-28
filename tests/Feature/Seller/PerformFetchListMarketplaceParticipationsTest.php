<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Seller;

use EolabsIo\AmazonMws\Domain\Sellers\Jobs\PerformFetchListMarketplaceParticipations;
use EolabsIo\AmazonMws\Domain\Sellers\Jobs\ProcessListMarketplaceParticipationsResponse;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListMarketplaceParticipations;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Facades\Queue;

class PerformFetchListMarketplaceParticipationsTest extends TestCase
{
    use CreatesListMarketplaceParticipations;

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
        $getMatchingProduct = $this->createListMarketplaceParticipations();

        PerformFetchListMarketplaceParticipations::dispatch($getMatchingProduct);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListMarketplaceParticipations::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListMarketplaceParticipationsResponse::class, function ($job) {
            return data_get($job->results, 'ListParticipations.0.MarketplaceId') === 'ATVPDKIKX0DER';
        });
    }
}
