<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Shared;

use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Domain\Shared\Csv;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\CsvHeaderRowCountMismatchException;

class CsvTest extends TestCase
{

    /** @test */
    public function it_can_read_a_csv_file()
    {
        $file = __DIR__ .'/../../Stubs/Responses/AmazonFulfilledShipments.csv';

        $rows = Csv::from($file)->getRows()->all();

        $this->assertCount(4, $rows);
        $this->assertEquals('100-3590565-0113041', $rows[0]['amazon-order-id']);
        $this->assertEquals('101-4340462-1457012', $rows[1]['amazon-order-id']);
        $this->assertEquals('102-7910932-2381033', $rows[2]['amazon-order-id']);
        $this->assertEquals('103-2260656-3601064', $rows[3]['amazon-order-id']);
    }

    /** @test */
    public function it_can_read_a_csv_file_with_snake_case_headers()
    {
        $file = __DIR__ .'/../../Stubs/Responses/AmazonFulfilledShipments.csv';

        $rows = Csv::from($file)->headersToSnakeCase()->getRows()->all();

        $this->assertCount(4, $rows);
        $this->assertEquals('100-3590565-0113041', $rows[0]['amazon_order_id']);
        $this->assertEquals('101-4340462-1457012', $rows[1]['amazon_order_id']);
        $this->assertEquals('102-7910932-2381033', $rows[2]['amazon_order_id']);
        $this->assertEquals('103-2260656-3601064', $rows[3]['amazon_order_id']);
    }

    /** @test */
    public function it_throws_exception_when_reading_a_csv_file()
    {
        $this->expectException(CsvHeaderRowCountMismatchException::class);

        $file = __DIR__ .'/../../Stubs/Responses/AmazonFulfilledShipmentsError.csv';

        $rows = Csv::from($file)->headersToSnakeCase()->getRows()->all();
    }
}
