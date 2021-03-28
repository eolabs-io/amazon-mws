<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerTaxInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\TaxClassification;

class TaxClassificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaxClassification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(30),
            'value' => $this->faker->text(30),
            'buyer_tax_info_id' => BuyerTaxInfo::factory(),
        ];
    }
}
