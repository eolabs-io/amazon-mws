<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupply;
use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupplyDetail;
use EolabsIo\AmazonMws\Domain\Shared\Models\Timepoint;

class InventorySupplyTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return InventorySupply::class;
    }

    /** @test */
    public function it_can_create_a_earliest_availability_relationship()
    {
        $inventorySupply = InventorySupply::factory()->create(['earliest_availability_id' => null]);
        $timepoint = Timepoint::factory()->make()->toArray();

        $earliestAvailability = $inventorySupply->earliestAvailability;
        $earliestAvailability->fill($timepoint)->save();

        $inventorySupply->earliestAvailability()
                        ->associate($earliestAvailability);

        $inventorySupply->save();

        $newEarliestAvailability = InventorySupply::find($inventorySupply->id)->earliestAvailability;

        $this->assertArraysEqual($newEarliestAvailability->toArray(), $earliestAvailability->toArray());
    }

    /** @test */
    public function it_can_create_supply_detail_relationship()
    {
        $inventorySupply = InventorySupply::factory()->times(10)->create()->first();

        $details = InventorySupplyDetail::factory()->times(10)->make()->toArray();

        $inventorySupply->details()->delete();
        $inventorySupply->details()->createMany($details);
        $details = $inventorySupply->details;

        $newDetails = InventorySupply::find($inventorySupply->id)->details;

        $this->assertArraysEqual($newDetails->toArray(), $details->toArray());
    }

    /** @test */
    public function it_can_have_duplicate_asin()
    {
        $inventorySupply1 = InventorySupply::factory()->create();
        $inventorySupply2 = InventorySupply::factory()->create(['asin' => $inventorySupply1->asin]);

        $this->assertDatabaseCount('inventory_supplies', 2);
    }
}
