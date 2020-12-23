<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reports;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Domain\Reports\Jobs\ImportAmazonFulfilledShipment;
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
        $filePath = __DIR__ .'/../../Stubs/Responses/AmazonFulfilledShipments.csv';
        $file = new File($filePath);

        ImportAmazonFulfilledShipments::dispatch($file);

        Queue::assertPushed(ImportAmazonFulfilledShipments::class, function ($job) {
            $job->handle();
            return true;
        });

        Queue::assertPushed(ImportAmazonFulfilledShipment::class, 4);
    }
}
