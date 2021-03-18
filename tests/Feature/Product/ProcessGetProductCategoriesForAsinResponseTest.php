<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Product;

use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetProductCategoriesForAsin;
use EolabsIo\AmazonMws\Domain\Products\Jobs\ProcessGetProductCategoriesForAsinResponse;

class ProcessGetProductCategoriesForAsinResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesGetProductCategoriesForAsin;

    /** @var EolabsIo\AmazonMws\Support\Facades\GetProductCategoriesForAsin */
    public $getProductCategoriesForAsin;

    /** @var Illuminate\Support\Collection */
    public $results;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_process_get_product_categories_for_asin_response()
    {
        $this->executeGetProductCategoriesForAsinResponse();

        $this->assertDatabaseCount('product_categories', 7);
        $this->assertDatabaseHas('product_categories', [
            "product_category_id" => "2420095011",
            "product_category_name" => "Compression Shorts",
            "parent_id" => "2419332011",
        ]);

        $this->assertDatabaseHas('product_categories', [
            "product_category_id" => "3375251",
            "product_category_name" => "Categories",
            "parent_id" => null,
        ]);
    }

    public function executeGetProductCategoriesForAsinResponse()
    {
        $this->getProductCategoriesForAsin = $this->createGetProductCategoriesForAsin();

        $this->results = $this->getProductCategoriesForAsin->fetch();

        (new ProcessGetProductCategoriesForAsinResponse($this->results))->handle();
    }
}
