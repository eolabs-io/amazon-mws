<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Product;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Support\Facades\GetMatchingProduct;
use EolabsIo\AmazonMws\Tests\Factories\GetMatchingProductFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class GetMatchingProductTest extends TestCase
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

    	GetMatchingProductFactory::new()->fakeGetMatchingProductResponse();

    	$store = StoreFactory::new()
              						 ->withValidAttributes()
              					   ->create();

      $response = GetMatchingProduct::withStore($store)
                            ->withMarketplaceId('ATVPDKIKX0DER')
                            ->withAsins(['B002KT3XRQ', 'B002KT8UYI'])
                            ->fetch();

      Http::assertSent(function ($request){
        	return $request->url() == 'https://mws.amazonservices.com/Products/2011-10-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
      				   $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
      				   $request['SellerId'] == 'A2NEXAMPLETF53' &&
      				   $request['Version'] == '2011-10-01' &&
      				   $request['SignatureMethod'] == 'HmacSHA256' &&
      				   $request['SignatureVersion'] == '2' &&
      				   $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
      				   $request['MarketplaceId'] == 'ATVPDKIKX0DER' &&
                 $request['ASINList.ASIN.1'] == 'B002KT3XRQ' &&
                 $request['ASINList.ASIN.2'] == 'B002KT8UYI' &&
      				   $request['Action'] == 'GetMatchingProduct' &&
      				   $request['Signature'] == '5dtxDVBOp9CVWSSWMkWryNyBfOPTnh+yVmF4TlM1JVI=';
        });

    }

    /** @test */
    public function it_can_get_matching_product()
    {
      GetMatchingProductFactory::new()->fakeGetMatchingProductResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->create();

      $response = GetMatchingProduct::withStore($store)
                            ->withMarketplaceId('ATVPDKIKX0DER')
                            ->withAsins(['B002KT3XRQ', 'B002KT8UYI'])
                            ->fetch();

      $product = $response['Products'][0]['Product'];

      $this->assertEquals($product['Identifiers']['MarketplaceASIN']['ASIN'], "B002KT3XRQ");
      $this->assertEquals($product['AttributeSets']['ItemAttributes']['Feature'][4], "86 percent nylon, 14% spandex, 9-Inch inseam");
      $this->assertEquals($product['Relationships']['VariationChild'][0]['Identifiers']['MarketplaceASIN']['ASIN'], "B002KT3XQC");
      $this->assertEquals($product['SalesRankings']['SalesRank'][1]['ProductCategoryId'], "2420095011");      
    }
}