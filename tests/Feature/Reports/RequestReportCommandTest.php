<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reports;

use EolabsIo\AmazonMws\Domain\Reports\Jobs\PerformRequestReport;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Facades\Queue;

class RequestReportCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_request_report_artisan_command()
    {
        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:request-report '.$store->id.'
                --report-type=_GET_AMAZON_FULFILLED_SHIPMENTS_DATA_
                --start-date=2020-12-10
                --end-date=2020-12-19
                ')
             ->assertExitCode(0);

        // Assert that job was called
        Queue::assertPushed(PerformRequestReport::class);
    }
}
