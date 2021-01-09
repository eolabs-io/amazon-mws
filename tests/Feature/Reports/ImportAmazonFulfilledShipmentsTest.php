<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reports;

use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Domain\Shared\Csv;
use EolabsIo\AmazonMws\Domain\Reports\Jobs\ImportAmazonFulfilledShipments;

class ImportAmazonFulfilledShipmentsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_import_amazon_fulfilled_shipments()
    {
        $file = __DIR__ .'/../../Stubs/Responses/AmazonFulfilledShipments.csv';

        Csv::from($file)
            ->headersToSnakeCase()
            ->getRows()
            ->chunk(100)
            ->each(function ($shipments) {
                ImportAmazonFulfilledShipments::dispatch($shipments);
            });


        Queue::assertPushed(ImportAmazonFulfilledShipments::class, function ($job) {
            $job->handle();
            return true;
        });

        $this->assertDatabaseCount('amazon_fulfilled_shipments', 5);
    }
}
