<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Products\Models\SalesRank;


class SalesRankTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return SalesRank::class;
    }

    /** @test */
    public function it_has_product_relationship()
    {
    	$product = factory(Product::class)->create();
        $salesRank = factory(SalesRank::class)->create(['product_id' => $product->id]);
        
        $this->assertArraysEqual($product->toArray(), $salesRank->product->toArray());
    }
}
