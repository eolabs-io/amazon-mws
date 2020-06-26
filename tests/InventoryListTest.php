<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Support\Facades\InventoryList;
use EolabsIo\AmazonMws\Tests\Factories\InventoryFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class InventoryListTest extends TestCase
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

    	InventoryFactory::new()->fakeFulfillmentInventoryResponse();

    	$store = StoreFactory::new()
    						 ->withValidAttributes()
    					     ->create();

        $response = InventoryList::withStore($store)->fetch();


        Http::assertSent(function ($request){

        	return $request->url() == 'https://mws.amazonservices.com/FulfillmentInventory/2010-10-01' &&
                   $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
				   $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
				   $request['SellerId'] == 'A2NEXAMPLETF53' &&
				   $request['Version'] == '2010-10-01' &&
				   $request['SignatureMethod'] == 'HmacSHA256' &&
				   $request['SignatureVersion'] == '2' &&
				   $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
				   $request['QueryStartDateTime'] == '2020-03-14T12:00:00Z' &&
				   $request['ResponseGroup'] == 'Basic' &&
				   $request['Action'] == 'ListInventorySupply' &&
				   $request['Signature'] == '2UvuQLLUpOmOw4KnXxJ/Z1cFTmb/dC0uNQrMJlrGV28=';
        });

    }

    /** @test */
    public function it_has_the_correct_store_id_in_the_response()
    {

        InventoryFactory::new()->fakeFulfillmentInventoryResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        $response = InventoryList::withStore($store)->fetch();

        $this->assertEquals($store->id, $response['store_id']);
    }

    /** @test */
    public function it_can_get_inventory()
    {
		InventoryFactory::new()->fakeFulfillmentInventoryResponse();
    	$store = StoreFactory::new()
    						 ->withValidAttributes()
    					     ->create();

        $response = InventoryList::withStore($store)->fetch();

		$this->assertArrayHasKey('InventorySupplyList', $response->toArray());

		$sampleSKU1 = data_get($response, 'InventorySupplyList.0.SellerSKU');
		$sampleSKU2 = data_get($response, 'InventorySupplyList.1.SellerSKU');

		$this->assertEquals($sampleSKU1, 'SampleSKU1');
		$this->assertEquals($sampleSKU2, 'SampleSKU2');

    }

    /** @test */
    public function it_can_get_inventory_with_token()
    {
		InventoryFactory::new()->fakeFulfillmentInventoryTokenResponse();
    	$store = StoreFactory::new()
    						 ->withValidAttributes()
    					     ->create();

        $inventoryList = InventoryList::withStore($store);              
        $response = $inventoryList->fetch();

        $this->assertTrue($inventoryList->hasNextToken());
            
        $nextTokenResponse = $inventoryList->fetch();

		$this->assertArrayHasKey('InventorySupplyList', $response->toArray());
        $this->assertArrayHasKey('InventorySupplyList', $nextTokenResponse->toArray());

		$sampleSKU1 = data_get($response, 'InventorySupplyList.0.SellerSKU');
		$sampleSKU2 = data_get($nextTokenResponse, 'InventorySupplyList.0.SellerSKU');

		$this->assertEquals($sampleSKU1, 'SampleSKU1');
		$this->assertEquals($sampleSKU2, 'SampleSKU2');

		$this->assertSentListInventorySupply();
		$this->assertSentListInventorySupplyByNextToken();

    }

    public function assertSentListInventorySupply()
    {
    	$requestResponsePairs = Http::recorded($cb = null);
		$request = $requestResponsePairs[0][0];

        $this->assertTrue(
        	 	   $request->url() == 'https://mws.amazonservices.com/FulfillmentInventory/2010-10-01' &&
                   $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
				   $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
				   $request['SellerId'] == 'A2NEXAMPLETF53' &&
				   $request['Version'] == '2010-10-01' &&
				   $request['SignatureMethod'] == 'HmacSHA256' &&
				   $request['SignatureVersion'] == '2' &&
				   $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
				   $request['QueryStartDateTime'] == '2020-03-14T12:00:00Z' &&
				   $request['ResponseGroup'] == 'Basic' &&
				   $request['Action'] == 'ListInventorySupply' &&
				   $request['Signature'] == '2UvuQLLUpOmOw4KnXxJ/Z1cFTmb/dC0uNQrMJlrGV28='
        );
    }

    public function assertSentListInventorySupplyByNextToken()
    {
    	$requestResponsePairs = Http::recorded($cb = null);
		$request = $requestResponsePairs[1][0];

        $this->assertTrue( 
        		   $request->url() == 'https://mws.amazonservices.com/FulfillmentInventory/2010-10-01' &&
                   $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
				   $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
				   $request['SellerId'] == 'A2NEXAMPLETF53' &&
				   $request['Version'] == '2010-10-01' &&
				   $request['SignatureMethod'] == 'HmacSHA256' &&
				   $request['SignatureVersion'] == '2' &&
				   $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
				   $request['NextToken'] == 'Token!' &&
				   $request['Action'] == 'ListInventorySupplyByNextToken' &&
				   $request['Signature'] == 'YacyQOUEXJCmQWWxAAhRSSrbhOscLey+PhhuZYmifSI='
        );
    }

}