<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;

class SafeTReimbursementItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SafeTReimbursementItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'safe_t_reimbursement_event_id' => SafeTReimbursementEvent::factory(),
        ];
    }
}
