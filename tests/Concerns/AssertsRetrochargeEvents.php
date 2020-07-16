<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\RetrochargeEvent;


trait AssertsRetrochargeEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent */
    public $retrochargeEvent;

    public function assertRetrochargeEventResponse()
    {
        $retrochargeEvent = RetrochargeEvent::where(["amazon_order_id" => "421-145158-7247662"])
                                            ->first();

        $this->assertSeesRetrochargeEvent($retrochargeEvent);
    }

    public function assertSeesRetrochargeEvent($event)
    {
        $this->retrochargeEvent = $event;

        $this->assertEquals($this->retrochargeEvent->amazon_order_id, "421-145158-7247662");
        $this->assertEquals($this->retrochargeEvent->retrocharge_event_type, "Retrocharge");
        $this->assertEquals($this->retrochargeEvent->marketplace_name, "Name of Marketplace");

        $baseTax = $this->retrochargeEvent->baseTax->toArray();
        $this->assertEquals($baseTax['currency_code'], "INR");
        $this->assertEquals($baseTax['currency_amount'], 10.0);

        $shippingTax = $this->retrochargeEvent->shippingTax->toArray();
        $this->assertEquals($shippingTax['currency_code'], "INR");
        $this->assertEquals($shippingTax['currency_amount'], 0.1);

        $retrochargeTaxWithheldComponentList = $this->retrochargeEvent->retrochargeTaxWithheldComponentList->load('taxesWithheld')->toArray();
        $this->assertEquals($retrochargeTaxWithheldComponentList[0]['tax_collection_model'], "MarketplaceFacilitator");

        $taxesWithheld = $retrochargeTaxWithheldComponentList[0]['taxes_withheld'][0];
        $this->assertEquals($taxesWithheld['charge_type'], "Discount");

        $this->retrochargeEvent = null;
    }

}