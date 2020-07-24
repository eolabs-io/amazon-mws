<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Products\Models\Feature;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;


class FeatureTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return Feature::class;
    }

    /** @test */
    public function it_has_item_attribute_relationship()
    {
        $itemAttribute = factory(ItemAttributes::class)->create();
        $feature = $this->factory()->create(['item_attribute_id' => $itemAttribute->id]);
        
        $this->assertArraysEqual($itemAttribute->toArray(), $feature->itemAttribute->toArray());
    }
}
