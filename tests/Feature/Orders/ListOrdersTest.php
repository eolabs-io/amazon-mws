<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Orders;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Support\Facades\ListOrders;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\Factories\ListOrdersFactory;
use EolabsIo\AmazonMwsClient\Database\Seeders\EndpointSeeder;

class ListOrdersTest extends TestCase
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
        ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

        $store = StoreFactory::new()
                                       ->withValidAttributes()
                                     ->create();

        $response = ListOrders::withStore($store)
                            ->withCreatedAfter(Carbon::create(2020, 6, 8, 12))
                            ->fetch();

        Http::assertSent(function ($request) {
            return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                         $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                         $request['SellerId'] == 'A2NEXAMPLETF53' &&
                         $request['Version'] == '2013-09-01' &&
                         $request['SignatureMethod'] == 'HmacSHA256' &&
                         $request['SignatureVersion'] == '2' &&
                         $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                         $request['CreatedAfter'] == '2020-06-08T12:00:00Z' &&
                         $request['Action'] == 'ListOrders' &&
                         $request['Signature'] == 'QTtYCbaDZHdgkv2hkp7Lh52YHVqgqlER55M8ky0OUvY=';
        });
    }

    /** @test */
    public function it_can_get_orders()
    {
        ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

        $store = StoreFactory::new()
                                       ->withValidAttributes()
                                     ->create();

        $response = ListOrders::withStore($store)->withCreatedAfter(Carbon::create(2020, 6, 8, 12))->fetch();

        $this->assertArrayHasKey('Orders', $response->toArray());

        $amazonOrderId1 = data_get($response, 'Orders.0.AmazonOrderId');
        $amazonOrderId2 = data_get($response, 'Orders.1.AmazonOrderId');

        $this->assertEquals($amazonOrderId1, '902-3159896-1390916');
        $this->assertEquals($amazonOrderId2, '483-3488972-0896720');
    }

    /** @test */
    public function it_can_get_orders_with_token()
    {
        $this->seed(EndpointSeeder::class);

        ListOrdersFactory::new()->fakeFulfillmentListOrdersTokenResponse();
        $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->withDefaultMarketplaces()
                           ->create();

        $listOrders = ListOrders::withStore($store)->withCreatedAfter(Carbon::create(2020, 6, 8, 12));
        $response = $listOrders->fetch();

        $this->assertTrue($listOrders->hasNextToken());

        $nextTokenResponse = $listOrders->fetch();

        $this->assertArrayHasKey('Orders', $response->toArray());
        $this->assertArrayHasKey('Orders', $nextTokenResponse->toArray());

        $amazonOrderId1 = data_get($response, 'Orders.0.AmazonOrderId');
        $amazonOrderId2 = data_get($nextTokenResponse, 'Orders.0.AmazonOrderId');

        $this->assertEquals($amazonOrderId1, '902-3159896-1390916');
        $this->assertEquals($amazonOrderId2, '058-1233752-8214740');

        $this->assertSentListOrders();
        $this->assertSentListOrdersByNextToken();
    }

    public function assertSentListOrders()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[0][0];

        $this->assertTrue(
            $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
         $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
         $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
         $request['SellerId'] == 'A2NEXAMPLETF53' &&
         $request['Version'] == '2013-09-01' &&
         $request['SignatureMethod'] == 'HmacSHA256' &&
         $request['SignatureVersion'] == '2' &&
         $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
         $request['Action'] == 'ListOrders' &&
         $request['MarketplaceId.Id.1'] == "ATVPDKIKX0DER" &&
         $request['Signature'] == 'hdUF5WoJJUFXnmV/TMrdZ0ZKUvIRab8/h4AuG4HNr3s='
        );
    }

    public function assertSentListOrdersByNextToken()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[1][0];

        $this->assertTrue(
            $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
           $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
           $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
           $request['SellerId'] == 'A2NEXAMPLETF53' &&
           $request['Version'] == '2013-09-01' &&
           $request['SignatureMethod'] == 'HmacSHA256' &&
           $request['SignatureVersion'] == '2' &&
           $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
           $request['NextToken'] == '2YgYW55IGNhcm5hbCBwbGVhc3VyZS4=' &&
           $request['Action'] == 'ListOrdersByNextToken' &&
           $request['Signature'] == 'fSdfHbaWujlkNamrJzyo0qd0S63WnHwSl9epU3d2l0w='
        );
    }
}
