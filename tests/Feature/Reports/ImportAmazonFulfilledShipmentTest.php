<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reports;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Domain\Shared\Csv;
use EolabsIo\AmazonMws\Domain\Reports\Jobs\ImportAmazonFulfilledShipment;

class ImportAmazonFulfilledShipmentTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_import_amazon_fulfilled_shipments()
    {
        $filePath = '/Users/timhall/code/packages/amazon-mws/tests/Stubs/Responses/AmazonFulfilledShipments.csv';

        $file = new File($filePath);

        $this->assertDatabaseCount('amazon_fulfilled_shipments', 0);

        Csv::from($file)
        ->eachRow(function ($row) use (&$importCount) {
            (new ImportAmazonFulfilledShipment($row))->handle();
        });

        $this->assertDatabaseCount('amazon_fulfilled_shipments', 4);
    }
}
