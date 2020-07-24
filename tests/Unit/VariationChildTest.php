<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Products\Models\VariationChild;


class VariationChildTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return VariationChild::class;
    }

    /** @test */
    public function it_has_product_relationship()
    {
    	$product = factory(Product::class)->create();
        $variationChild = factory(VariationChild::class)->create(['product_id' => $product->id]);
        
        $this->assertArraysEqual($product->toArray(), $variationChild->product->toArray());
    }
}
