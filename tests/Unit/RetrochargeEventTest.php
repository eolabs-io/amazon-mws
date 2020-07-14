<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\RetrochargeEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;

class RetrochargeEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return RetrochargeEvent::class;
    }

    /** @test */
    public function it_has_baseTax_relationship()
    {
        $retrochargeEvent = factory(RetrochargeEvent::class)->create(['base_tax_id' => null]);
        $baseTax = factory(CurrencyAmount::class)->create();

        $retrochargeEvent->baseTax()->associate($baseTax);

        $this->assertArraysEqual($baseTax->toArray(), $retrochargeEvent->baseTax->toArray());
    }

    /** @test */
    public function it_has_shippingTax_relationship()
    {
        $retrochargeEvent = factory(RetrochargeEvent::class)->create(['shipping_tax_id' => null]);
        $shippingTax = factory(CurrencyAmount::class)->create();

        $retrochargeEvent->shippingTax()->associate($shippingTax);

        $this->assertArraysEqual($shippingTax->toArray(), $retrochargeEvent->shippingTax->toArray());
    }

    /** @test */
    public function it_has_retrochargeTaxWithheldComponentList_relationship()
    {
        $retrochargeEvent = factory(RetrochargeEvent::class)->create();
        $retrochargeTaxWithheldComponentList = factory(TaxWithheldComponent::class, 5)->create();

        $retrochargeEvent->retrochargeTaxWithheldComponentList()->toggle($retrochargeTaxWithheldComponentList);

        $this->assertArraysEqual($retrochargeTaxWithheldComponentList->toArray(), 
        						 $retrochargeEvent->retrochargeTaxWithheldComponentList->toArray());
    }
}
