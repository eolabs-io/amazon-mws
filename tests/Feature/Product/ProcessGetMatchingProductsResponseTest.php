<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Product;

use EolabsIo\AmazonMws\Domain\Products\Jobs\ProcessGetMatchingProductsResponse;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetMatchingProduct;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProcessGetMatchingProductsResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesGetMatchingProduct;

    /** @var EolabsIo\AmazonMws\Support\Facades\GetMatchingProduct */
    public $getMatchingProduct;

    /** @var Illuminate\Support\Collection */
    public $results;

    protected function setUp(): void
    {
        parent::setUp();

        // $this->executeProcessGetMatchingProductsResponse();
    }

    /** @test */
    public function it_can_process_product_response()
    {
        $this->executeProcessGetMatchingProductsResponse();

        $product = Product::where(["asin" => "B002KT3XRQ", "marketplace_id" => "ATVPDKIKX0DER"])
                          ->first();

        $attributeSet = $product->attributeSets->first();
        $this->assertSeesAttributeSet($attributeSet);

        $relationships = $product->relationships->first();
        $this->assertSeesRelationships($relationships);

        $salesRankings = $product->salesRankings->first();
        $this->assertSeesSalesRankings($salesRankings);
    }

    /** @test */
    public function it_can_handle_product_error_response()
    {
        $this->executeProcessGetMatchingProductsWithErrorResponse();
        (new ProcessGetMatchingProductsResponse($this->results))->handle();
        
        $this->assertDatabaseCount('features', 0);
        $this->assertDatabaseCount('images', 0);
        $this->assertDatabaseCount('item_attributes', 0);
        $this->assertDatabaseCount('item_dimensions', 0);
        $this->assertDatabaseCount('package_dimensions', 0);
        $this->assertDatabaseCount('products', 0);
        $this->assertDatabaseCount('sales_ranks', 0);
        $this->assertDatabaseCount('variation_children', 0);
    }

    /** @test */
    public function it_can_update_product_response()
    {
        $this->executeProcessGetMatchingProductsResponse();
        (new ProcessGetMatchingProductsResponse($this->results))->handle();
        
        $this->assertDatabaseCount('features', 5);
        $this->assertDatabaseCount('images', 1);
        $this->assertDatabaseCount('item_attributes', 1);
        $this->assertDatabaseCount('item_dimensions', 1);
        $this->assertDatabaseCount('package_dimensions', 1);
        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseCount('sales_ranks', 3);
        $this->assertDatabaseCount('variation_children', 5);
    }

    public function assertSeesAttributeSet($attributeSet)
    {
        $this->assertEquals($attributeSet->binding, "Apparel");
        $this->assertEquals($attributeSet->brand, "Pearl iZUMi");
        $this->assertEquals($attributeSet->itemDimension->height, 2.00);
        $this->assertEquals($attributeSet->itemDimension->length, 9.00);
        $this->assertEquals($attributeSet->packageDimension->height, 2.80);
        $this->assertEquals($attributeSet->packageDimension->width, 8.40);
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

    public function executeProcessGetMatchingProductsResponse()
    {
        $this->getMatchingProduct = $this->createGetMatchingProduct();

        $this->results = $this->getMatchingProduct->fetch();

        (new ProcessGetMatchingProductsResponse($this->results))->handle();
    }

    public function executeProcessGetMatchingProductsWithErrorResponse()
    {
        $this->getMatchingProduct = $this->createGetMatchingProductWithError();

        $this->results = $this->getMatchingProduct->fetch();

        (new ProcessGetMatchingProductsResponse($this->results))->handle();
    }
}