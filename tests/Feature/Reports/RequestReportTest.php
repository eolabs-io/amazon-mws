<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Support\Facades\RequestReport;
use EolabsIo\AmazonMws\Tests\Factories\RequestReportFactory;

class RequestReportTest extends TestCase
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
        RequestReportFactory::new()->fakeRequestReportResponse();

        $store = StoreFactory::new()
            ->withValidAttributes()
            ->create();

        $startDate = Carbon::create(2020, 3, 24, 12);
        $endDate = Carbon::create(2020, 3, 24, 12);
        $marketplaceIds = ['ATVPDKIKX0DER'];

        RequestReport::withStore($store)
            ->withReportTypeFbaAmazonFulfilledShipmentsReport()
            ->withStartDate($startDate)
            ->withEndDate($endDate)
            ->withMarketplaceIdList($marketplaceIds)
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
                    $request['ReportType'] == '_GET_AMAZON_FULFILLED_SHIPMENTS_DATA_' &&
                    $request['StartDate'] == '2020-03-24T12:00:00Z' &&
                    $request['EndDate'] == '2020-03-24T12:00:00Z' &&
                    $request['MarketplaceIdList.Id.1'] == 'ATVPDKIKX0DER' &&
                    $request['Action'] == 'RequestReport' &&
                    $request['Signature'] == 'I4txRIMWPTSh8i3mEERXYsFQDaHEplbXd6mi1LmjmXQ=';
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        RequestReportFactory::new()->fakeRequestReportResponse();

        $store = StoreFactory::new()
            ->withValidAttributes()
            ->create();


        $response = RequestReport::withStore($store)->fetch();

        $reportRequestInfo = $response['ReportRequestInfo'];

        $this->assertEquals(2291326454, $reportRequestInfo['ReportRequestId']);
        $this->assertEquals('_GET_MERCHANT_LISTINGS_DATA_', $reportRequestInfo['ReportType']);
        $this->assertEquals('2009-01-21T02:10:39+00:00', $reportRequestInfo['StartDate']);
        $this->assertEquals('2009-02-13T02:10:39+00:00', $reportRequestInfo['EndDate']);
        $this->assertEquals('false', $reportRequestInfo['Scheduled']);
        $this->assertEquals('2009-02-20T02:10:39+00:00', $reportRequestInfo['SubmittedDate']);
        $this->assertEquals('_SUBMITTED_', $reportRequestInfo['ReportProcessingStatus']);
    }
}
