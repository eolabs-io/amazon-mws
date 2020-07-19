<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use EolabsIo\AmazonMws\Tests\Factories\BaseFactory;
use EolabsIo\AmazonMws\Tests\Factories\Concerns\HasAmazonMwsErrorResponses;
use Illuminate\Support\Facades\Http;


class ListOrdersFactory
{
    use HasAmazonMwsErrorResponses;
    
	private $endpoint = 'mws.amazonservices.com/Orders/2013-09-01';

    public static function new(): self
    {
        return new static();
    }

	public function fake(): self
	{
    	Http::fake();

    	return $this;
	}

	public function fakeFulfillmentListOrdersResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchListOrders.xml';
    	$listOrdersResponse = file_get_contents($file);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listOrdersResponse, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}

	public function fakeFulfillmentListOrdersTokenResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchListOrdersToken.xml';
    	$listOrdersTokenResponse = file_get_contents($file);

    	$file2 = __DIR__ . '/../Stubs/Responses/fetchListOrdersToken2.xml';
    	$listOrdersToken2Response = file_get_contents($file2);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listOrdersTokenResponse, 200)
		                            ->push($listOrdersToken2Response, 200)
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