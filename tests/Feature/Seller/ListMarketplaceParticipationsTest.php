<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Seller;

use EndpointSeeder;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Support\Facades\ListMarketplaceParticipations;
use EolabsIo\AmazonMws\Tests\Factories\ListMarketplaceParticipationsFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;


class ListMarketplaceParticipationsTest extends TestCase
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
    public function it_sends_the_correct_list_marketplace_participations_request_query()
    {

    	ListMarketplaceParticipationsFactory::new()->fakeListMarketplaceParticipationsResponse();

    	$store = StoreFactory::new()
              						 ->withValidAttributes()
              					   ->create();

      $response = ListMarketplaceParticipations::withStore($store)->fetch();

      Http::assertSent(function ($request){
        	return $request->url() == 'https://mws.amazonservices.com/Sellers/2011-07-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
      				   $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
      				   $request['SellerId'] == 'A2NEXAMPLETF53' &&
      				   $request['Version'] == '2011-07-01' &&
      				   $request['SignatureMethod'] == 'HmacSHA256' &&
      				   $request['SignatureVersion'] == '2' &&
      				   $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
      				   $request['Action'] == 'ListMarketplaceParticipations' &&
      				   $request['Signature'] == 'eWOe00DjOudIlffX0UO9qB66B+KU5MOfH/qtMKkPI+M=';
        });

    }

    /** @test */
    public function it_can_get_list_marketplace_participations()
    {
  		ListMarketplaceParticipationsFactory::new()->fakeListMarketplaceParticipationsResponse();
      
      $store = StoreFactory::new()
      						         ->withValidAttributes()
      					           ->create();

      $response = ListMarketplaceParticipations::withStore($store)->fetch();

  		$marketplaceId = data_get($response, 'ListParticipations.0.MarketplaceId');
  		$sellerId = data_get($response, 'ListParticipations.0.SellerId');
  		$this->assertEquals($marketplaceId, 'ATVPDKIKX0DER');
  		$this->assertEquals($sellerId, 'A135KKEKJAIBJ56');
      
      $name = data_get($response, 'ListMarketplaces.0.Name');
      $defaultCountryCode = data_get($response, 'ListMarketplaces.0.DefaultCountryCode');
      $this->assertEquals($name, 'Amazon.com');
      $this->assertEquals($defaultCountryCode, 'US');
    }

    /** @test */
    public function it_can_get_list_marketplace_participations_with_token()
    {
      $this->seed(EndpointSeeder::class);

      ListMarketplaceParticipationsFactory::new()->fakeListMarketplaceParticipationsTokenResponse();
      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->withDefaultMarketplaces()
                           ->create();

      $listMarketplaceParticipations = ListMarketplaceParticipations::withStore($store);              
      $response = $listMarketplaceParticipations->fetch();

      $this->assertTrue($listMarketplaceParticipations->hasNextToken());
            
      $nextTokenResponse = $listMarketplaceParticipations->fetch();

      $this->assertArrayHasKey('ListParticipations', $response->toArray());
      $this->assertArrayHasKey('ListParticipations', $nextTokenResponse->toArray());

      $marketplaceId = data_get($response, 'ListParticipations.0.MarketplaceId');

      $this->assertEquals($marketplaceId, 'ATVPDKIKX0DER');

      $this->assertSentListMarketplaceParticipations();
      $this->assertSentListMarketplaceParticipationsByNextToken();

    }

    public function assertSentListMarketplaceParticipations()
    {
      $requestResponsePairs = Http::recorded($cb = null);
      $request = $requestResponsePairs[0][0];

      $this->assertTrue(
         $request->url() == 'https://mws.amazonservices.com/Sellers/2011-07-01' &&
         $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
         $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
         $request['SellerId'] == 'A2NEXAMPLETF53' &&
         $request['Version'] == '2011-07-01' &&
         $request['SignatureMethod'] == 'HmacSHA256' &&
         $request['SignatureVersion'] == '2' &&
         $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
         $request['Action'] == 'ListMarketplaceParticipations' &&
         $request['Signature'] == 'eWOe00DjOudIlffX0UO9qB66B+KU5MOfH/qtMKkPI+M='
      );
    }

    public function assertSentListMarketplaceParticipationsByNextToken()
    {
      $requestResponsePairs = Http::recorded($cb = null);
      $request = $requestResponsePairs[1][0];

      $this->assertTrue( 
         $request->url() == 'https://mws.amazonservices.com/Sellers/2011-07-01' &&
         $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
         $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
         $request['SellerId'] == 'A2NEXAMPLETF53' &&
         $request['Version'] == '2011-07-01' &&
         $request['SignatureMethod'] == 'HmacSHA256' &&
         $request['SignatureVersion'] == '2' &&
         $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
         $request['Action'] == 'ListMarketplaceParticipationsByNextToken' &&
         $request['NextToken'] == 'MRgZW55IGNhcm5hbCBwbGVhc3VyZS6=' &&
         $request['Signature'] == 'ooJLv1FBPQZs+NZiqDgkXkopLQF77vxYz4S2GG4NEbM='
      );
    }

}