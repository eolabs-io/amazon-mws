<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Support\Facades\GetReportList;
use EolabsIo\AmazonMws\Tests\Factories\GetReportListFactory;

class GetReportListTest extends TestCase
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
        GetReportListFactory::new()->fakeResponse();

        $store = StoreFactory::new()
            ->withValidAttributes()
            ->create();

        $reportRequestIds = ['2291326454'];
        $types = ['_GET_ORDERS_DATA_', '_GET_MERCHANT_LISTINGS_DATA_'];
        $maxCount = 20;
        $fromDate = Carbon::create(2020, 2, 24, 12);
        $toDate = Carbon::create(2020, 3, 24, 12);

        GetReportList::withStore($store)
            ->withMaxCount($maxCount)
            ->withReportTypes($types)
            ->WithAcknowledged(true)
            ->withReportRequestIds($reportRequestIds)
            ->withAvailableFromDate($fromDate)
            ->withAvailableToDate($toDate)
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
                    $request['ReportRequestIdList.Id.1'] == '2291326454' &&
                    $request['ReportTypeList.Type.1'] == '_GET_ORDERS_DATA_' &&
                    $request['ReportTypeList.Type.2'] == '_GET_MERCHANT_LISTINGS_DATA_' &&
                    $request['Acknowledged'] == true &&
                    $request['MaxCount'] == 20 &&
                    $request['Action'] == 'GetReportList' &&
                    $request['AvailableFromDate'] == '2020-02-24T12:00:00Z' &&
                    $request['AvailableToDate'] == '2020-03-24T12:00:00Z' &&
                    $request['Signature'] == 'mw8oJrdblWDnGwVBj8zdgPepwYTANdQboidySljRpQ8=';
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        GetReportListFactory::new()->fakeResponse();

        $store = StoreFactory::new()
            ->withValidAttributes()
            ->create();


        $response = GetReportList::withStore($store)->fetch();

        $reportInfo = $response['ReportInfo'];

        $this->assertEquals(898899473, $reportInfo['ReportId']);
        $this->assertEquals('_GET_MERCHANT_LISTINGS_DATA_', $reportInfo['ReportType']);
        $this->assertEquals('2278662938', $reportInfo['ReportRequestId']);
        $this->assertEquals('2009-02-10T09:22:33+00:00', $reportInfo['AvailableDate']);
        $this->assertEquals('false', $reportInfo['Acknowledged']);
    }
}
