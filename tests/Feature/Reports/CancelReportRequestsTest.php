<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Support\Facades\CancelReportRequests;
use EolabsIo\AmazonMws\Tests\Factories\CancelReportRequestsFactory;

class CancelReportRequestsTest extends TestCase
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
        CancelReportRequestsFactory::new()->fakeCancelReportRequestsResponse();

        $store = StoreFactory::new()
            ->withValidAttributes()
            ->create();

        $reportRequestIds = ['2291326454'];
        $types = ['_GET_ORDERS_DATA_', '_GET_MERCHANT_LISTINGS_DATA_'];
        $processingStatuses = ['_DONE_'];
        $maxCount = 20;
        $fromDate = Carbon::create(2020, 2, 24, 12);
        $toDate = Carbon::create(2020, 3, 24, 12);

        CancelReportRequests::withStore($store)
            ->withReportRequestIds($reportRequestIds)
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
                    $request['ReportRequestIdList.Id.1'] == '2291326454' &&
                    $request['ReportTypeList.Type.1'] == '_GET_ORDERS_DATA_' &&
                    $request['ReportTypeList.Type.2'] == '_GET_MERCHANT_LISTINGS_DATA_' &&
                    $request['ReportProcessingStatusList.Status.1'] == '_DONE_' &&
                    $request['Action'] == 'CancelReportRequests' &&
                    $request['Signature'] == '2wtchmJyqmVrUof2f95evUCobfFKDSb5qFwFDTjnC78=';
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        CancelReportRequestsFactory::new()->fakeCancelReportRequestsResponse();

        $store = StoreFactory::new()
            ->withValidAttributes()
            ->create();

        $response = CancelReportRequests::withStore($store)->fetch();

        $this->assertEquals(1, $response['Count']);

        $reportRequestInfo = $response['ReportRequestInfo'];

        $this->assertEquals('2291326454', $reportRequestInfo['ReportRequestId']);
        $this->assertEquals('_GET_MERCHANT_LISTINGS_DATA_', $reportRequestInfo['ReportType']);
        $this->assertEquals('2009-01-21T02:10:39+00:00', $reportRequestInfo['StartDate']);
        $this->assertEquals('2009-02-13T02:10:39+00:00', $reportRequestInfo['EndDate']);
        $this->assertEquals('false', $reportRequestInfo['Scheduled']);
        $this->assertEquals('2009-02-20T02:10:39+00:00', $reportRequestInfo['SubmittedDate']);
        $this->assertEquals('_CANCELLED_', $reportRequestInfo['ReportProcessingStatus']);
    }
}
