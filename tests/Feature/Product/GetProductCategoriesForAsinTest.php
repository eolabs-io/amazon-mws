<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Product;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Support\Facades\GetProductCategoriesForAsin;
use EolabsIo\AmazonMws\Tests\Factories\GetProductCategoriesForAsinFactory;

class GetProductCategoriesForAsinTest extends TestCase
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
        GetProductCategoriesForAsinFactory::new()->fakeResponse();

        $store = StoreFactory::new()
                                     ->withValidAttributes()
                                     ->create();

        $response = GetProductCategoriesForAsin::withStore($store)
                            ->withMarketplaceId('ATVPDKIKX0DER')
                            ->withAsin('B002KT3XRQ')
                            ->fetch();

        Http::assertSent(function ($request) {
            return $request->url() == 'https://mws.amazonservices.com/Products/2011-10-01' &&
                $request['AWSAccessKeyId'] == '0PB842EXAMPLE7N4ZTR2' &&
                $request['MWSAuthToken'] == 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE' &&
                $request['SellerId'] == 'A2NEXAMPLETF53' &&
                $request['Version'] == '2011-10-01' &&
                $request['SignatureMethod'] == 'HmacSHA256' &&
                $request['SignatureVersion'] == '2' &&
                $request['Timestamp'] == '2020-03-24T12:00:00Z' &&
                $request['MarketplaceId'] == 'ATVPDKIKX0DER' &&
                $request['ASIN'] == 'B002KT3XRQ' &&
                $request['Action'] == 'GetProductCategoriesForASIN' &&
                $request['Signature'] == 'UxdlDUdawhaslDysypp0KU4weYKgrqhXkIiFx3LeQcw=';
        });
    }

    /** @test */
    public function it_can_get_product_categories_for_asin()
    {
        GetProductCategoriesForAsinFactory::new()->fakeResponse();

        $store = StoreFactory::new()
                           ->withValidAttributes()
                           ->create();

        $response = GetProductCategoriesForAsin::withStore($store)
                            ->withMarketplaceId('ATVPDKIKX0DER')
                            ->withAsin('B002KT3XRQ')
                            ->fetch();

        // dd($response);
        $productCategories = $response['Self'];

        $this->assertEquals(2420095011, $productCategories['ProductCategoryId']);
        $this->assertEquals('Compression Shorts', $productCategories['ProductCategoryName']);
        $this->assertCount(3, $productCategories['Parent']);
    }
}
