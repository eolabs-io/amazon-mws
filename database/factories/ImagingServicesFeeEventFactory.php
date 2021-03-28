<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\ImagingServicesFeeEvent;

class ImagingServicesFeeEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImagingServicesFeeEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'imaging_request_billing_item_id' => $this->faker->text(),
            'asin' => $this->faker->text(),
            'posted_date' => $this->faker->dateTime(),
        ];
    }
}
