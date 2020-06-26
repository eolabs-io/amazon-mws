<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMws\Support\Facades\InventoryServiceStatus;
use EolabsIo\AmazonMws\Tests\Factories\InventoryFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;


class InventoryServiceStatusTest extends TestCase
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
    	InventoryFactory::new()->fakeGetServiceStatusResponse();

    	$store = StoreFactory::new()
    						 ->withValidAttributes()
    					     ->create();

        $response = InventoryServiceStatus::withStore($store)->fetch();

        Http::assertSent(function ($request){

        	return $request->url() == 'https://mws.amazonservices.com/FulfillmentInventory/2010-10-01' &&
                   $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
				   $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
				   $request['SellerId'] == 'A2NEXAMPLETF53' &&
				   $request['Version'] == '2010-10-01' &&
				   $request['SignatureMethod'] == 'HmacSHA256' &&
				   $request['SignatureVersion'] == '2' &&
				   $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
				   $request['Action'] == 'GetServiceStatus' &&
				   $request['Signature'] == 'cr/Bka3QBLO1lIcu0kbm6YGUD1McKaWjJz89SUpv8WA=';
        });
    }

    /** @test */
    public function it_can_get_inventory()
    {
    	InventoryFactory::new()->fakeGetServiceStatusResponse();

    	$store = StoreFactory::new()
    						 ->withValidAttributes()
    					     ->create();

        $response = InventoryServiceStatus::withStore($store)->fetch();

		$this->assertArrayHasKey('GetServiceStatusResult', $response->toArray());

		$status = data_get($response, 'GetServiceStatusResult.Status');
		$timestamp = data_get($response, 'GetServiceStatusResult.Timestamp');

		$this->assertEquals($status, 'GREEN');
		$this->assertEquals($timestamp, '2010-11-01T21:38:09.676Z');

    }
}