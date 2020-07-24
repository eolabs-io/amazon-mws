<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Products\Models\SalesRank;
use EolabsIo\AmazonMws\Domain\Products\Models\VariationChild;

class ProductTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return Product::class;
    }

    /** @test */
    public function it_has_attribute_sets_relationship()
    {
        $product = $this->factory()->create();
        $itemAttributes = factory(ItemAttributes::class, 3)->create(['product_id' => $product->id]);

        $this->assertArraysEqual($itemAttributes->toArray(), $product->itemAttributes->toArray());
    }

    /** @test */
    public function it_has_product_relationship_relationship()
    {
        $product = $this->factory()->create();
        $variationChildren = factory(VariationChild::class, 3)->create(['product_id' => $product->id]);

        $this->assertArraysEqual($variationChildren->toArray(), $product->relationships->toArray());
    }

    /** @test */
    public function it_has_sales_ranking_relationship()
    {
        $product = $this->factory()->create();
        $salesRank = factory(SalesRank::class, 3)->create(['product_id' => $product->id]);

        $this->assertArraysEqual($salesRank->toArray(), $product->salesRankings->toArray());
    }
}
