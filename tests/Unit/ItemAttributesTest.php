<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Products\Models\Image;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemDimension;
use EolabsIo\AmazonMws\Domain\Products\Models\PackageDimension;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;

class ItemAttributesTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ItemAttributes::class;
    }

    /** @test */
    public function it_has_product_relationship()
    {
        $product = Product::factory()->create();
        $itemAttributes = ItemAttributes::factory()->create(['product_id' => $product->id]);

        $this->assertArraysEqual($product->toArray(), $itemAttributes->product->toArray());
    }

    /** @test */
    public function it_has_itemDimensions_relationship()
    {
        $itemAttributes = ItemAttributes::factory()->create(['item_dimension_id' => null]);
        $itemDimension = ItemDimension::factory()->create();

        $itemAttributes->itemDimension()->associate($itemDimension);

        $this->assertArraysEqual($itemDimension->toArray(), $itemAttributes->itemDimension->toArray());
    }

    /** @test */
    public function it_has_packageDimensions_relationship()
    {
        $itemAttributes = ItemAttributes::factory()->create(['package_dimension_id' => null]);
        $packageDimension = PackageDimension::factory()->create();

        $itemAttributes->packageDimension()->associate($packageDimension);

        $this->assertArraysEqual($packageDimension->toArray(), $itemAttributes->packageDimension->toArray());
    }

    /** @test */
    public function it_has_smallImage_relationship()
    {
        $itemAttributes = ItemAttributes::factory()->create(['small_image_id' => null]);
        $smallImage = Image::factory()->create();

        $itemAttributes->smallImage()->associate($smallImage);

        $this->assertArraysEqual($smallImage->toArray(), $itemAttributes->smallImage->toArray());
    }
}
