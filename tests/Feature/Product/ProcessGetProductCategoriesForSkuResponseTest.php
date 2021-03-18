<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Product;

use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetProductCategoriesForSku;
use EolabsIo\AmazonMws\Domain\Products\Jobs\ProcessGetProductCategoriesForSkuResponse;

class ProcessGetProductCategoriesForSkuResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesGetProductCategoriesForSku;

    /** @var EolabsIo\AmazonMws\Support\Facades\GetProductCategoriesForSku */
    public $getProductCategoriesForSku;

    /** @var Illuminate\Support\Collection */
    public $results;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_process_get_product_categories_for_sku_response()
    {
        $this->executeGetProductCategoriesForSkuResponse();

        $this->assertDatabaseCount('product_categories', 9);
        $this->assertDatabaseHas('product_categories', [
            "product_category_id" => "271578011",
            "product_category_name" => "Project Management",
            "parent_id" => "2675",
        ]);

        $this->assertDatabaseHas('product_categories', [
            "product_category_id" => "283155",
            "product_category_name" => "Specialty Boutique",
            "parent_id" => null,
        ]);
    }

    public function executeGetProductCategoriesForSkuResponse()
    {
        $this->getProductCategoriesForSku = $this->createGetProductCategoriesForSku();

        $this->results = $this->getProductCategoriesForSku->fetch();

        (new ProcessGetProductCategoriesForSkuResponse($this->results))->handle();
    }
}
