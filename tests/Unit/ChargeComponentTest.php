<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class ChargeComponentTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return ChargeComponent::class;
    }

    /** @test */
    public function it_has_chargeAmount_relationship()
    {
        $chargeComponent = factory(ChargeComponent::class)->create(['charge_amount_id' => null]);
        $chargeAmount = factory(CurrencyAmount::class)->create();

        $chargeComponent->chargeAmount()->associate($chargeAmount);

        $this->assertArraysEqual($chargeAmount->toArray(), $chargeComponent->chargeAmount->toArray());
    }
}
