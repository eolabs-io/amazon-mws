<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceProviderCreditEvent;


trait AssertsServiceProviderCreditEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent */
    public $serviceProviderCreditEvent;

    public function assertServiceProviderCreditEventResponse()
    {
        $serviceProviderCreditEvent = ServiceProviderCreditEvent::where(["seller_order_id" => "201-0457358-1247562"])
                                            ->first();

        $this->assertSeesServiceProviderCreditEvent($serviceProviderCreditEvent);
    }

    public function assertSeesServiceProviderCreditEvent($event)
    {
        $this->serviceProviderCreditEvent = $event;

        $this->assertEquals($this->serviceProviderCreditEvent->provider_transaction_type, "ProviderCredit");
        $this->assertEquals($this->serviceProviderCreditEvent->seller_order_id, "201-0457358-1247562");
        $this->assertEquals($this->serviceProviderCreditEvent->marketplace_id, "ADFJDK54IO");

        $this->serviceProviderCreditEvent = null;
    }

}