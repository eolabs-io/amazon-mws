<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent;


trait AssertsPayWithAmazonEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent */
    public $payWithAmazonEvent;

    public function assertPayWithAmazonEventResponse()
    {
        $payWithAmazonEvent = PayWithAmazonEvent::where(["seller_order_id" => "111-0457358-1247562"])
                                            ->first();

        $this->assertSeesPayWithAmazonEvent($payWithAmazonEvent);
    }

    public function assertSeesPayWithAmazonEvent($event)
    {
        $this->payWithAmazonEvent = $event;

        $this->assertEquals($this->payWithAmazonEvent->seller_order_id, "111-0457358-1247562");
        $this->assertEquals($this->payWithAmazonEvent->business_object_type, "PaymentContract");
        $this->assertEquals($this->payWithAmazonEvent->sales_channel, "FBA");

        $charge = $this->payWithAmazonEvent->charge->load('chargeAmount')->toArray();
        $this->assertEquals($charge['charge_type'], "Tax");
        $this->assertEquals($charge['charge_amount']['currency_amount'], 6.38);

        $feeList = $this->payWithAmazonEvent->feeList->load('feeAmount')->toArray();
        $this->assertEquals($feeList[0]['fee_type'], "Subscription");
        $this->assertEquals($feeList[1]['fee_amount']['currency_amount'], 0.34);

        $this->payWithAmazonEvent = null;
    }

}