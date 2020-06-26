<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use EolabsIo\AmazonMws\Tests\Factories\BaseFactory;
use Illuminate\Support\Facades\Http;


class InventoryFactory
{

	private $endpoint = 'mws.amazonservices.com/FulfillmentInventory/2010-10-01';

    public static function new(): self
    {
        return new static();
    }

	public function fake(): self
	{
    	Http::fake();

    	return $this;
	}

	public function fakeFulfillmentInventoryResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchInventoryList.xml';
    	$listInventorySupplyResponse = file_get_contents($file);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listInventorySupplyResponse, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}

	public function fakeFulfillmentInventoryTokenResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchInventoryListToken.xml';
    	$listInventorySupplyTokenResponse = file_get_contents($file);

    	$file = __DIR__ . '/../Stubs/Responses/fetchInventoryListToken2.xml';
    	$listInventorySupplyToken2Response = file_get_contents($file);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listInventorySupplyTokenResponse, 200)
		                            ->push($listInventorySupplyToken2Response, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}

    public function fakeGetServiceStatusResponse()
    {
        $file = __DIR__ . '/../Stubs/Responses/fetchGetServiceStatus.xml';
        $getServiceStatusResponse = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($getServiceStatusResponse, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);
        
        return $this;
    }

}