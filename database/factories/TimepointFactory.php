<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Shared\Models\Timepoint;

class TimepointFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Timepoint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement(['Immediately' ,'DateTime', 'Unknown']);

        return [
            'timepoint_type' => $type,
            'date_time' => ($type === 'DateTime') ? $this->faker->dateTime() : null,
        ];
    }
}
