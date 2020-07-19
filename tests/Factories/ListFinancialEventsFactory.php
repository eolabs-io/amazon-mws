<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use EolabsIo\AmazonMws\Tests\Factories\Concerns\HasAmazonMwsErrorResponses;
use Illuminate\Support\Facades\Http;


class ListFinancialEventsFactory
{
    use HasAmazonMwsErrorResponses;

	private $endpoint = 'mws.amazonservices.com/Finances/2015-05-01';

    public static function new(): self
    {
        return new static();
    }

	public function fake(): self
	{
    	Http::fake();

    	return $this;
	}

	public function fakeListFinancialEventsResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchListFinancialEvents.xml';
    	$listFinancialEventsResponse = file_get_contents($file);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listFinancialEventsResponse, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}

	public function fakeListFinancialEventsTokenResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchListFinancialEventsToken.xml';
    	$listFinancialEventsTokenResponse = file_get_contents($file);

    	$file2 = __DIR__ . '/../Stubs/Responses/fetchListFinancialEventsToken2.xml';
    	$listFinancialEventsToken2Response = file_get_contents($file2);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listFinancialEventsTokenResponse, 200)
		                            ->push($listFinancialEventsToken2Response, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}

}