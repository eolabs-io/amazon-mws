<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent;

class PayWithAmazonEventTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return PayWithAmazonEvent::class;
    }

    /** @test */
    public function it_has_charge_relationship()
    {
        $payWithAmazonEvent = PayWithAmazonEvent::factory()->create(['charge_id' => null]);
        $charge = ChargeComponent::factory()->create();

        $payWithAmazonEvent->charge()->associate($charge);

        $this->assertArraysEqual($charge->toArray(), $payWithAmazonEvent->charge->toArray());
    }

    /** @test */
    public function it_has_feeList_relationship()
    {
        $payWithAmazonEvent = PayWithAmazonEvent::factory()->create();
        $feeList = FeeComponent::factory()->times(3)->create();

        $payWithAmazonEvent->feeList()->toggle($feeList);

        $this->assertArraysEqual($feeList->toArray(), $payWithAmazonEvent->feeList->toArray());
    }
}
