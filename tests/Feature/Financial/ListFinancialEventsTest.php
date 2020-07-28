<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Financial;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Support\Facades\ListFinancialEvents;
use EolabsIo\AmazonMws\Tests\Factories\ListFinancialEventsFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EndpointSeeder;


class ListFinancialEventsTest extends TestCase
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

    	ListFinancialEventsFactory::new()->fakeListFinancialEventsResponse();

    	$store = StoreFactory::new()
              						 ->withValidAttributes()
              					   ->create();

      $response = ListFinancialEvents::withStore($store)
                            ->withPostedAfter( Carbon::create(2020, 6, 8, 12) )
                            ->fetch();

      Http::assertSent(function ($request){
        	return $request->url() == 'https://mws.amazonservices.com/Finances/2015-05-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
      				   $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
      				   $request['SellerId'] == 'A2NEXAMPLETF53' &&
      				   $request['Version'] == '2015-05-01' &&
      				   $request['SignatureMethod'] == 'HmacSHA256' &&
      				   $request['SignatureVersion'] == '2' &&
      				   $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
      				   $request['PostedAfter'] == '2020-06-08T12:00:00Z' &&
      				   $request['Action'] == 'ListFinancialEvents' &&
      				   $request['Signature'] == 'hn7N5VFazpg+H3aEUuMh2dLV9V+qHPyg98PtGJ2PUyQ=';
        });

    }

    /** @test */
    public function it_can_get_financial_events()
    {
  		ListFinancialEventsFactory::new()->fakeListFinancialEventsResponse();
      
      $store = StoreFactory::new()
      						         ->withValidAttributes()
      					           ->create();

      $response = ListFinancialEvents::withStore($store)
                                          ->withPostedAfter( Carbon::create(2020, 6, 8, 12) )->fetch();


  		$this->assertArrayHasKey('FinancialEvents', $response->toArray());

  		$dealDescription = data_get($response, 'FinancialEvents.SellerDealPaymentEventList.0.DealDescription');

  		$this->assertEquals($dealDescription, 'test fees');

      
    }

    /** @test */
    public function it_can_get_orders_with_token()
    {
      $this->seed(EndpointSeeder::class);

      ListFinancialEventsFactory::new()->fakeListFinancialEventsTokenResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->withDefaultMarketplaces()
                           ->create();

      $ListFinancialEvents = ListFinancialEvents::withStore($store)
                                                ->withPostedAfter( Carbon::create(2020, 6, 8, 12) );              
      $response = $ListFinancialEvents->fetch();

      $this->assertTrue($ListFinancialEvents->hasNextToken());
            
      $nextTokenResponse = $ListFinancialEvents->fetch();

      $this->assertArrayHasKey('FinancialEvents', $response->toArray());
      $this->assertArrayHasKey('FinancialEvents', $nextTokenResponse->toArray());

      $dealDescription1 = data_get($response, 'FinancialEvents.SellerDealPaymentEventList.0.DealDescription');
      $dealDescription2 = data_get($nextTokenResponse, 'FinancialEvents.SellerDealPaymentEventList.0.DealDescription');

      $this->assertEquals($dealDescription1, 'test fees');
      $this->assertEquals($dealDescription2, '__test fees__'); 

      $this->assertSentListFinancialEvents();
      $this->assertSentListFinancialEventsByNextToken();

    }

    public function assertSentListFinancialEvents()
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
         $request['PostedAfter'] == '2020-06-08T12:00:00Z' &&
         $request['Action'] == 'ListFinancialEvents' &&
         $request['Signature'] == 'hn7N5VFazpg+H3aEUuMh2dLV9V+qHPyg98PtGJ2PUyQ='
      );
    }

    public function assertSentListFinancialEventsByNextToken()
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
         $request['Action'] == 'ListFinancialEventsByNextToken' &&
         $request['Signature'] == '0lSmdOXucwgq7HxeKWOvv/qs8e6/AEX7gHOKycc/CXI='
      );
    }

}