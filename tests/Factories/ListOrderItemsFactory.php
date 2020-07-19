<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use EolabsIo\AmazonMws\Tests\Factories\BaseFactory;
use EolabsIo\AmazonMws\Tests\Factories\Concerns\HasAmazonMwsErrorResponses;
use Illuminate\Support\Facades\Http;


class ListOrderItemsFactory
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

	public function fakeListOrderItemsResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchListOrderItems.xml';
    	$listOrderItemsResponse = file_get_contents($file);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listOrderItemsResponse, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}

	public function fakeListOrderItemsTokenResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchListOrderItemsToken.xml';
    	$listOrderItemsTokenResponse = file_get_contents($file);

    	$file2 = __DIR__ . '/../Stubs/Responses/fetchlistOrderItemsToken2.xml';
    	$listOrderItemsToken2Response = file_get_contents($file2);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listOrderItemsTokenResponse, 200)
		                            ->push($listOrderItemsToken2Response, 200)
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