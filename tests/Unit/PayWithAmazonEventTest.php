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
        $payWithAmazonEvent = factory(PayWithAmazonEvent::class)->create(['charge_id' => null]);
        $charge = factory(ChargeComponent::class)->create();
        $charge->load('chargeAmount');

        $payWithAmazonEvent->charge()->associate($charge);

        $this->assertArraysEqual($charge->toArray(), $payWithAmazonEvent->charge->toArray());
    }

    /** @test */
    public function it_has_feeList_relationship()
    {
        $payWithAmazonEvent = factory(PayWithAmazonEvent::class)->create();
        $feeList = factory(FeeComponent::class, 3)->create();
        $feeList->load('feeAmount');

        $payWithAmazonEvent->feeList()->toggle($feeList);

        $this->assertArraysEqual($feeList->toArray(), $payWithAmazonEvent->feeList->toArray());
    }

}
