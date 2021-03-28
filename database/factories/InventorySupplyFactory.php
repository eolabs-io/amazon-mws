<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Shared\Models\Timepoint;
use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupply;

class InventorySupplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventorySupply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $condition = $this->faker->randomElement(['NewItem','NewWithWarranty','NewOEM','NewOpenBox','UsedLikeNew','UsedVeryGood','UsedGood','UsedAcceptable','UsedPoor','UsedRefurbished','CollectibleLikeNew','CollectibleVeryGood','CollectibleGood','CollectibleAcceptable','CollectiblePoor','RefurbishedWithWarranty','Refurbished','Club',
        ]);

        return [
            'seller_sku' => $this->faker->unique()->text(14),
            'fnsku' => $this->faker->unique()->text(14),
            'asin' => $this->faker->unique()->text(14),
            'condition' => $condition,
            'total_supply_quantity' => $this->faker->numberBetween(1, 9999),
            'in_stock_supply_quantity' => $this->faker->numberBetween(1, 9999),
            'earliest_availability_id' => Timepoint::factory(),
            'in_use' => $this->faker->boolean(95),
        ];
    }
}
