<?php

namespace EolabsIo\AmazonMws\Tests;


use EolabsIo\AmazonMws\Domain\Products\Jobs\ProcessGetMatchingProductsResponse;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetMatchingProduct;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProcessGetMatchingProductsResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesGetMatchingProduct;


    protected function setUp(): void
    {
        parent::setUp();
        
        $getMatchingProduct = $this->createGetMatchingProduct();

        $results = $getMatchingProduct->fetch();

        (new ProcessGetMatchingProductsResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_list_financial_event_groups_response()
    {
        $product = Product::where(["asin" => "B002KT3XRQ"])
                          ->first();

        $attributeSet = $product->attributeSets->first();
        $this->assertSeesAttributeSet($attributeSet);

        $relationships = $product->relationships->first();
        $this->assertSeesRelationships($relationships);

        $salesRankings = $product->salesRankings->first();
        $this->assertSeesSalesRankings($salesRankings);
    }

    public function assertSeesAttributeSet($attributeSet)
    {
        $this->assertEquals($attributeSet->binding, "Apparel");
        $this->assertEquals($attributeSet->brand, "Pearl iZUMi");
        $this->assertEquals($attributeSet->itemDimension->height, "2.00");
        $this->assertEquals($attributeSet->itemDimension->length, "9.00");
        $this->assertEquals($attributeSet->packageDimension->height, "2.80");
        $this->assertEquals($attributeSet->packageDimension->width, "8.40");
        $this->assertEquals($attributeSet->smallImage->url, "http://ecx.images-amazon.com/images/I/41ty3Sn%2BU8L._SL75_.jpg");
        $this->assertEquals($attributeSet->features[4]['feature'], "86 percent nylon, 14% spandex, 9-Inch inseam");
    }

    public function assertSeesRelationships($relationships)
    {
        $this->assertEquals($relationships->color, "Black");
        $this->assertEquals($relationships->size, "Small");
    }

    public function assertSeesSalesRankings($salesRankings)
    {
        $this->assertEquals($salesRankings->product_category_id, "apparel_display_on_website");
        $this->assertEquals($salesRankings->rank, "159");
    }

}