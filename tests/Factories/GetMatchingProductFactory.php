<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use EolabsIo\AmazonMws\Tests\Factories\BaseFactory;
use EolabsIo\AmazonMws\Tests\Factories\Concerns\HasAmazonMwsErrorResponses;
use Illuminate\Support\Facades\Http;


class GetMatchingProductFactory
{
    use HasAmazonMwsErrorResponses;
    
	private $endpoint = 'mws.amazonservices.com/Products/2011-10-01';

    public static function new(): self
    {
        return new static();
    }

	public function fake(): self
	{
    	Http::fake();

    	return $this;
	}

	public function fakeGetMatchingProductResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchGetMatchingProduct.xml';
    	$getMatchingProductResponse = file_get_contents($file);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($getMatchingProductResponse, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}
	
    public function fakeGetMatchingProductWithErrorResponse(): self
    {

        $file = __DIR__ . '/../Stubs/Responses/fetchGetMatchingProductWithError.xml';
        $getMatchingProductResponse = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($getMatchingProductResponse, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }
}