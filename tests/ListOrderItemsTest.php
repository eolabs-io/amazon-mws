<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Support\Facades\ListOrderItems;
use EolabsIo\AmazonMws\Tests\Factories\ListOrderItemsFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class ListOrderItemsTest extends TestCase
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
    public function it_sends_the_correct_order_item_request_query()
    {

    	ListOrderItemsFactory::new()->fakeListOrderItemsResponse();

    	$store = StoreFactory::new()
              						 ->withValidAttributes()
              					   ->create();

      $response = ListOrderItems::withStore($store)
                                ->withAmazonOrderId( '058-1233752-8214740' )
                                ->fetch();

      Http::assertSent(function ($request){
        	return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
      				   $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
      				   $request['SellerId'] == 'A2NEXAMPLETF53' &&
      				   $request['Version'] == '2013-09-01' &&
      				   $request['SignatureMethod'] == 'HmacSHA256' &&
      				   $request['SignatureVersion'] == '2' &&
      				   $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
      				   $request['AmazonOrderId'] == '058-1233752-8214740' &&
      				   $request['Action'] == 'ListOrderItems' &&
      				   $request['Signature'] == '+z2sdTGWJU9jFHf0LYpgVT6rjlR3b5i4laTihSdx+Lo=';
        });

    }

    /** @test */
    public function it_can_get_order_items()
    {
  		ListOrderItemsFactory::new()->fakeListOrderItemsResponse();
      
      $store = StoreFactory::new()
      						         ->withValidAttributes()
      					           ->create();

      $response = ListOrderItems::withStore($store)->withAmazonOrderId( '058-1233752-8214740' )->fetch();

  		$this->assertArrayHasKey('OrderItems', $response->toArray());

  		$asin1 = data_get($response, 'OrderItems.0.ASIN');
  		$asin2 = data_get($response, 'OrderItems.1.ASIN');

  		$this->assertEquals($asin1, 'BT0093TELA');
  		$this->assertEquals($asin2, 'BCTU1104UEFB');
      
    }

    /** @test */
    public function it_can_get_order_items_with_token()
    {
      $this->seed();

      ListOrderItemsFactory::new()->fakeListOrderItemsTokenResponse();
      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->withDefaultMarketplaces()
                           ->create();

      $listOrderItems = ListOrderItems::withStore($store)->withAmazonOrderId( '058-1233752-8214740' );              
      $response = $listOrderItems->fetch();

      $this->assertTrue($listOrderItems->hasNextToken());
            
      $nextTokenResponse = $listOrderItems->fetch();

      $this->assertArrayHasKey('OrderItems', $response->toArray());
      $this->assertArrayHasKey('OrderItems', $nextTokenResponse->toArray());

      $asin1 = data_get($response, 'OrderItems.0.ASIN');

      $this->assertEquals($asin1, 'BT0093TELA');

      $this->assertSentListOrderItems();
      $this->assertSentListOrderItemsByNextToken();

    }

    public function assertSentListOrderItems()
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
         $request['AmazonOrderId'] == '058-1233752-8214740' &&
         $request['Action'] == 'ListOrderItems' &&
         $request['Signature'] == '+z2sdTGWJU9jFHf0LYpgVT6rjlR3b5i4laTihSdx+Lo='
      );
    }

    public function assertSentListOrderItemsByNextToken()
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
         $request['Action'] == 'ListOrderItemsByNextToken' &&
         $request['NextToken'] == 'MRgZW55IGNhcm5hbCBwbGVhc3VyZS6=' &&
         $request['Signature'] == 'H5TWwGq029XRScXC+nHsLnI0vDrRjSHeh8blUeLo028='
      );
    }

}