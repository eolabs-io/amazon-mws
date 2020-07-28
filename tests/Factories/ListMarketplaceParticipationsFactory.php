<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use EolabsIo\AmazonMws\Tests\Factories\Concerns\HasAmazonMwsErrorResponses;
use Illuminate\Support\Facades\Http;


class ListMarketplaceParticipationsFactory
{
    use HasAmazonMwsErrorResponses;

	private $endpoint = 'mws.amazonservices.com/Sellers/2011-07-01';

    public static function new(): self
    {
        return new static();
    }

	public function fake(): self
	{
    	Http::fake();

    	return $this;
	}

	public function fakeListMarketplaceParticipationsResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchListMarketplaceParticipations.xml';
    	$listMarketplaceParticipationsResponse = file_get_contents($file);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listMarketplaceParticipationsResponse, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}

	public function fakeListMarketplaceParticipationsTokenResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchListMarketplaceParticipationsToken.xml';
    	$listMarketplaceParticipationsTokenResponse = file_get_contents($file);

    	$file2 = __DIR__ . '/../Stubs/Responses/fetchListMarketplaceParticipationsToken2.xml';
    	$listMarketplaceParticipationsToken2Response = file_get_contents($file2);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listMarketplaceParticipationsTokenResponse, 200)
		                            ->push($listMarketplaceParticipationsToken2Response, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}

}