<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Support\Facades\ListOrders;
use EolabsIo\AmazonMws\Tests\Factories\ListOrdersFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class ListOrderRequestParameterTest extends TestCase
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
    public function it_can_set_create_before_and_after()
    {

      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->withCreatedAfter( Carbon::create(2020, 5, 8, 12) )
                            ->withCreatedBefore( Carbon::create(2020, 6, 8, 12) )
                            ->fetch();

      Http::assertSent(function ($request){
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['CreatedAfter'] == '2020-05-08T12:00:00Z' &&
                 $request['CreatedBefore'] == '2020-06-08T12:00:00Z' &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == 'TvM2nPr1k+gSiAZ2TGqNsiD3x/POtEF0B/mUPfz2i+g=';
        });

    }

    /** @test */
    public function it_can_set_last_updated_before_and_after()
    {

      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->withLastUpdatedAfter( Carbon::create(2020, 5, 8, 12) )
                            ->withLastUpdatedBefore( Carbon::create(2020, 6, 8, 12) )
                            ->fetch();

      Http::assertSent(function ($request){
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['LastUpdatedAfter'] == '2020-05-08T12:00:00Z' &&
                 $request['LastUpdatedBefore'] == '2020-06-08T12:00:00Z' &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == '21d2cVtvkEK7fW84ZEVuLp5Ou8kzX+l+2fShGniG2gs=';
        });

    }

/** @test */
    public function it_can_set_orderstatus()
    {

      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->withOrderStatusPendingAvailability() // Add PendingAvailability
                            ->withOrderStatusAll() // Remove all
                            ->withOrderStatusShipped()
                            ->withOrderStatusPartiallyShipped()
                            ->fetch();

      Http::assertSent(function ($request){
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['OrderStatus.Status.1'] == 'Shipped' &&
                 $request['OrderStatus.Status.2'] == 'PartiallyShipped' &&
                 $request['OrderStatus.Status.3'] == 'Unshipped' &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == 'LGy+x92g/t/Ry1Hu4aNuW909/oZm5W3T6WiJNmd+bBI=';
        });

    }

    /** @test */
    public function it_can_set_marketplace_ids()
    {

      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->withMarketplaceIds(['A1AM78C64UM0Y8', 'ATVPDKIKX0DER'])
                            ->fetch();

      Http::assertSent(function ($request){
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['MarketplaceId.Id.1'] == 'A1AM78C64UM0Y8' &&
                 $request['MarketplaceId.Id.2'] == 'ATVPDKIKX0DER' &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == 'UTEglncIQVqx7CrXC9seI6o56KUgM2JYyUJtpSg1NWI=';
        });

    }

    /** @test */
    public function it_sets_default_marketplace_ids()
    {
      $this->seed();
      
      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->withDefaultMarketplaces()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->fetch();

      Http::assertSent(function ($request){
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['MarketplaceId.Id.1'] == 'ATVPDKIKX0DER' &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == 'HLOEvqjk1OHhCyVaULOo2DKPo5GUrCIKd8UevFbsMN0=';
        });

    }

    /** @test */
    public function it_sets_fulfillmentChannels()
    {
      $this->seed();
      
      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->withDefaultMarketplaces()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->withFulfillmentChannelByAmazon()
                            ->withFulfillmentChannelBySeller()
                            ->fetch();

      Http::assertSent(function ($request){
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['MarketplaceId.Id.1'] == 'ATVPDKIKX0DER' &&
                 $request['FulfillmentChannel.Channel.1'] == 'AFN' &&
                 $request['FulfillmentChannel.Channel.2'] == 'MFN' &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == '+4jtepa9EFvMJ//EtSxkRXetyoWMj3+meslSCfZEAPU=';
        });

    }

    /** @test */
    public function it_sets_PaymentMethod()
    {
      $this->seed();
      
      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->withDefaultMarketplaces()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->withPaymentMethodCOD()
                            ->withPaymentMethodOther()
                            ->fetch();

      Http::assertSent(function ($request){
        // dd($request);
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['MarketplaceId.Id.1'] == 'ATVPDKIKX0DER' &&
                 $request['PaymentMethod.Method.1'] == 'COD' &&
                 $request['PaymentMethod.Method.2'] == 'Other' &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == 'nrXK0/kmNNf2Ljvu8LmK4dQ4p+x60b//uT4aUCkKv8c=';
        });

    }

    /** @test */
    public function it_can_set_buyer_email()
    {

      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->withBuyerEmail( 'thall@eolabs.io' )
                            ->fetch();

      Http::assertSent(function ($request){
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['BuyerEmail'] == 'thall@eolabs.io' &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == 'ZNj5m73KZEPYz/8F7jn1oHCjxIFxTFaIJHIBWrhOzfo=';
        });

    }

    /** @test */
    public function it_can_set_seller_order_id()
    {

      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->withSellerOrderId( '111-1111111-1111111' )
                            ->fetch();

      Http::assertSent(function ($request){
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['SellerOrderId'] == '111-1111111-1111111' &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == 'wadEtqYuqbRuRrNFh1hzP6ZIRDRsV808VpDPS6icw7I=';
        });

    }

    /** @test */
    public function it_can_set_max_results_per_page()
    {

      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->withMaxResultsPerPage(50)
                            ->fetch();

      Http::assertSent(function ($request){
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['MaxResultsPerPage'] == 50 &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == 'i+I/F8j7nEphjzILNpqgtDncv+QPV4HkgczfhRpckxg=';
        });

    }

    /** @test */
    public function it_can_set_easy_ship_shipment_status()
    {

      ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

      $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->create();

      $response = ListOrders::withStore($store)
                            ->withEasyShipShipmentStatusLost()
                            ->withEasyShipShipmentStatusUndeliverable()
                            ->fetch();

      Http::assertSent(function ($request){
          return $request->url() == 'https://mws.amazonservices.com/Orders/2013-09-01' &&
                 $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                 $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                 $request['SellerId'] == 'A2NEXAMPLETF53' &&
                 $request['Version'] == '2013-09-01' &&
                 $request['SignatureMethod'] == 'HmacSHA256' &&
                 $request['SignatureVersion'] == '2' &&
                 $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                 $request['EasyShipShipmentStatus.Status.1'] == 'Lost' &&
                 $request['EasyShipShipmentStatus.Status.2'] == 'Undeliverable' &&
                 $request['Action'] == 'ListOrders' &&
                 $request['Signature'] == '2tW2/waXjl4m1FhAt2MyGklf7Fuaiz02SkBSzWHdazY=';
        });

    }

}