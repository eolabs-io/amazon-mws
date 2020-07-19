<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use EolabsIo\AmazonMws\Tests\Factories\Concerns\HasAmazonMwsErrorResponses;
use Illuminate\Support\Facades\Http;


class ListFinancialEventGroupsFactory
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

	public function fakeListFinancialEventGroupsResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchListFinancialEventGroups.xml';
    	$listFinancialEventGroupsResponse = file_get_contents($file);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listFinancialEventGroupsResponse, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}

	public function fakeListFinancialEventGroupsTokenResponse(): self
	{

    	$file = __DIR__ . '/../Stubs/Responses/fetchListFinancialEventGroupsToken.xml';
    	$listFinancialEventGroupsTokenResponse = file_get_contents($file);

    	$file2 = __DIR__ . '/../Stubs/Responses/fetchListFinancialEventGroupsToken2.xml';
    	$listFinancialEventGroupsToken2Response = file_get_contents($file2);

    	Http::fake([
		     $this->endpoint => Http::sequence()
		                            ->push($listFinancialEventGroupsTokenResponse, 200)
		                            ->push($listFinancialEventGroupsToken2Response, 200)
		                            ->whenEmpty(Http::response('', 404)),
    	]);

    	return $this;
	}

}