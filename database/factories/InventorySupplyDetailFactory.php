<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Shared\Models\Timepoint;
use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupply;
use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupplyDetail;

class InventorySupplyDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventorySupplyDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $supplyType = $this->faker->randomElement(['InStock' ,'Inbound', 'Transfer']);

        return [
            'inventory_supply_id' => InventorySupply::factory(),
            'quantity' => $this->faker->numberBetween(1, 9999),
            'supply_type' => $supplyType,
            'earliest_available_to_pick_id' => Timepoint::factory(),
            'latest_available_to_pick_id' => Timepoint::factory(),
        ];
    }
}
