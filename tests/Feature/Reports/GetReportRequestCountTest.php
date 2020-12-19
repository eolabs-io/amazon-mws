<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Support\Facades\GetReportRequestCount;
use EolabsIo\AmazonMws\Tests\Factories\GetReportRequestListFactory;
use EolabsIo\AmazonMws\Tests\Factories\GetReportRequestCountFactory;

class GetReportRequestCountTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $knownDate = Carbon::create(2020, 3, 24, 12);
        Carbon::setTestNow($knownDate);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Carbon::setTestNow();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        GetReportRequestCountFactory::new()->fakeGetReportRequestCountResponse();

        $store = StoreFactory::new()
            ->withValidAttributes()
            ->create();

        $types = ['_GET_ORDERS_DATA_', '_GET_MERCHANT_LISTINGS_DATA_'];
        $processingStatuses = ['_DONE_'];
        $fromDate = Carbon::create(2020, 2, 24, 12);
        $toDate = Carbon::create(2020, 3, 24, 12);

        GetReportRequestCount::withStore($store)
            ->withReportTypes($types)
            ->withReportProcessingStatuses($processingStatuses)
            ->withRequestedFromDate($fromDate)
            ->withRequestedToDate($toDate)
            ->fetch();

        Http::assertSent(function ($request) {
            return $request->url() == "https://mws.amazonservices.com/Reports/2009-01-01" &&
                    $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                    $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                    $request['SellerId'] == 'A2NEXAMPLETF53' &&
                    $request['Version'] == '2009-01-01' &&
                    $request['SignatureMethod'] == 'HmacSHA256' &&
                    $request['SignatureVersion'] == '2' &&
                    $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                    $request['ReportTypeList.Type.1'] == '_GET_ORDERS_DATA_' &&
                    $request['ReportTypeList.Type.2'] == '_GET_MERCHANT_LISTINGS_DATA_' &&
                    $request['ReportProcessingStatusList.Status.1'] == '_DONE_' &&
                    $request['RequestedFromDate'] == '2020-02-24T12:00:00Z' &&
                    $request['Action'] == 'GetReportRequestCount' &&
                    $request['Signature'] == 'kjSSENbzXJqKfoLd5CAy2O6jUMARazJ60RkM7A7SKaI=';
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        GetReportRequestCountFactory::new()->fakeGetReportRequestCountResponse();

        $store = StoreFactory::new()
            ->withValidAttributes()
            ->create();


        $response = GetReportRequestCount::withStore($store)->fetch();

        $this->assertEquals(1276, $response['Count']);
    }
}
