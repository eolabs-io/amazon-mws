<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Financial;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMwsClient\Database\Seeders\EndpointSeeder;
use EolabsIo\AmazonMws\Support\Facades\ListFinancialEventGroups;
use EolabsIo\AmazonMws\Tests\Factories\ListFinancialEventGroupsFactory;

class ListFinancialEventGroupsTest extends TestCase
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
        ListFinancialEventGroupsFactory::new()->fakeListFinancialEventGroupsResponse();

        $store = StoreFactory::new()
                         ->withValidAttributes()
                         ->create();

        $response = ListFinancialEventGroups::withStore($store)
                            ->withFinancialEventGroupStartedAfter(Carbon::create(2020, 6, 8, 12))
                            ->fetch();

        Http::assertSent(function ($request) {
            return $request->url() == 'https://mws.amazonservices.com/Finances/2015-05-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                         $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                         $request['SellerId'] == 'A2NEXAMPLETF53' &&
                         $request['Version'] == '2015-05-01' &&
                         $request['SignatureMethod'] == 'HmacSHA256' &&
                         $request['SignatureVersion'] == '2' &&
                         $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                         $request['FinancialEventGroupStartedAfter'] == '2020-06-08T12:00:00Z' &&
                         $request['Action'] == 'ListFinancialEventGroups' &&
                         $request['Signature'] == 'a9iiowfx2yr7w60qQ/cDT4kSX9curi7RoKXV29v/XtU=';
        });
    }

    /** @test */
    public function it_can_get_orders()
    {
        ListFinancialEventGroupsFactory::new()->fakeListFinancialEventGroupsResponse();

        $store = StoreFactory::new()
                                       ->withValidAttributes()
                                     ->create();

        $response = ListFinancialEventGroups::withStore($store)
                                          ->withFinancialEventGroupStartedAfter(Carbon::create(2020, 6, 8, 12))->fetch();

        $this->assertArrayHasKey('FinancialEventGroupList', $response->toArray());

        $financialEventGroupId = data_get($response, 'FinancialEventGroupList.0.FinancialEventGroupId');
        $processingStatus = data_get($response, 'FinancialEventGroupList.0.ProcessingStatus');

        $this->assertEquals($financialEventGroupId, '22YgYW55IGNhcm5hbCBwbGVhEXAMPLE');
        $this->assertEquals($processingStatus, 'Closed');
    }

    /** @test */
    public function it_can_get_orders_with_token()
    {
        $this->seed(EndpointSeeder::class);

        ListFinancialEventGroupsFactory::new()->fakeListFinancialEventGroupsTokenResponse();

        $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->withDefaultMarketplaces()
                           ->create();

        $ListFinancialEventGroups = ListFinancialEventGroups::withStore($store)
                                                          ->withFinancialEventGroupStartedAfter(Carbon::create(2020, 6, 8, 12));
        $response = $ListFinancialEventGroups->fetch();

        $this->assertTrue($ListFinancialEventGroups->hasNextToken());

        $nextTokenResponse = $ListFinancialEventGroups->fetch();

        $this->assertArrayHasKey('FinancialEventGroupList', $response->toArray());
        $this->assertArrayHasKey('FinancialEventGroupList', $nextTokenResponse->toArray());

        $financialEventGroupId1 = data_get($response, 'FinancialEventGroupList.0.FinancialEventGroupId');
        $financialEventGroupId2 = data_get($nextTokenResponse, 'FinancialEventGroupList.0.FinancialEventGroupId');

        $this->assertEquals($financialEventGroupId1, '22YgYW55IGNhcm5hbCBwbGVhEXAMPLE');
        $this->assertEquals($financialEventGroupId2, '22YgYW55IsddsfdfsGNhcm5hbCBwbGVhEXAMPLE');

        $this->assertSentListFinancialEventGroups();
        $this->assertSentListFinancialEventGroupsByNextToken();
    }

    public function assertSentListFinancialEventGroups()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[0][0];

        $this->assertTrue(
            $request->url() == 'https://mws.amazonservices.com/Finances/2015-05-01' &&
         $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
         $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
         $request['SellerId'] == 'A2NEXAMPLETF53' &&
         $request['Version'] == '2015-05-01' &&
         $request['SignatureMethod'] == 'HmacSHA256' &&
         $request['SignatureVersion'] == '2' &&
         $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
         $request['FinancialEventGroupStartedAfter'] == '2020-06-08T12:00:00Z' &&
         $request['Action'] == 'ListFinancialEventGroups' &&
         $request['Signature'] == 'a9iiowfx2yr7w60qQ/cDT4kSX9curi7RoKXV29v/XtU='
        );
    }

    public function assertSentListFinancialEventGroupsByNextToken()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[1][0];

        $this->assertTrue(
            $request->url() == 'https://mws.amazonservices.com/Finances/2015-05-01' &&
         $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
         $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
         $request['SellerId'] == 'A2NEXAMPLETF53' &&
         $request['Version'] == '2015-05-01' &&
         $request['SignatureMethod'] == 'HmacSHA256' &&
         $request['SignatureVersion'] == '2' &&
         $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
         $request['NextToken'] == '2YgYW55IGNhcm5hbCBwbGVhcEXAMPLE' &&
         $request['Action'] == 'ListFinancialEventGroupsByNextToken' &&
         $request['Signature'] == 'mFdljIZFRW9mhbB/8fH4qnEk7vZ4rZW9dmfHKWuzE/U='
        );
    }
}
